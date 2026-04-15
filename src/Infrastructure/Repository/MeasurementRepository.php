<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Measurement;
use App\Domain\Filter\Sensor\SensorFilter;
use App\Domain\Repository\MeasurementRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\Attribute\Target;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class MeasurementRepository extends ServiceEntityRepository implements MeasurementRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        #[Target('cache.measurements')] private readonly CacheInterface $cacheMeasurements,
    ) {
        parent::__construct($registry, Measurement::class);
    }

    public function getSensorMeasurementsByFilter(string $sensorId, SensorFilter $sensorFilter): array
    {
        $qb = $this->createQueryBuilder('m');
        $qb
            ->where('m.sensor = :sensorId')
            ->setParameter('sensorId', $sensorId);

        if ($sensorFilter->timePeriodStart) {
            $qb
                ->andWhere('m.createdAt >= :timePeriodStart')
                ->setParameter('timePeriodStart', $sensorFilter->timePeriodStart);
        }
        if ($sensorFilter->timePeriodEnd) {
            $qb
                ->andWhere('m.createdAt <= :timePeriodEnd')
                ->setParameter('timePeriodEnd', $sensorFilter->timePeriodEnd);
        }

        return $qb->getQuery()->getResult();
    }

    public function getWeeklyAggregated(string $sensorId): array
    {
        $weekStart = new \DateTimeImmutable('7 days ago midnight');
        $cacheKey  = sprintf('weekly_%s_%s', $sensorId, $weekStart->format('Y-m-d'));

        return $this->cacheMeasurements->get($cacheKey, function (ItemInterface $item) use ($sensorId, $weekStart) {
            $item->expiresAfter(900); // 15 min

            $sql = '
                SELECT
                    ROUND(AVG(m.pm10)) AS pm10,
                    ROUND(AVG(m.pm25)) AS pm25,
                    MIN(m.created_at)  AS createdAt
                FROM measurement m
                WHERE m.sensor_id = :sensorId
                  AND m.created_at >= :weekStart
                GROUP BY DATE(m.created_at), FLOOR(HOUR(m.created_at) / 4)
                ORDER BY DATE(m.created_at) ASC, FLOOR(HOUR(m.created_at) / 4) ASC
            ';

            return $this->getEntityManager()
                ->getConnection()
                ->executeQuery($sql, [
                    'sensorId'  => $sensorId,
                    'weekStart' => $weekStart->format('Y-m-d H:i:s'),
                ])
                ->fetchAllAssociative();
        });
    }

    public function getMonthlyAggregated(string $sensorId): array
    {
        $monthStart = new \DateTimeImmutable('30 days ago midnight');
        $cacheKey   = sprintf('monthly_%s_%s', $sensorId, $monthStart->format('Y-m-d'));

        return $this->cacheMeasurements->get($cacheKey, function (ItemInterface $item) use ($sensorId, $monthStart) {
            $item->expiresAfter(3600); // 1h

            $sql = '
                SELECT
                    ROUND(AVG(m.pm10)) AS pm10,
                    ROUND(AVG(m.pm25)) AS pm25,
                    DATE(m.created_at) AS createdAt
                FROM measurement m
                WHERE m.sensor_id = :sensorId
                  AND m.created_at >= :monthStart
                GROUP BY DATE(m.created_at)
                ORDER BY DATE(m.created_at) ASC
            ';

            return $this->getEntityManager()
                ->getConnection()
                ->executeQuery($sql, [
                    'sensorId'   => $sensorId,
                    'monthStart' => $monthStart->format('Y-m-d H:i:s'),
                ])
                ->fetchAllAssociative();
        });
    }

    public function getRangeAggregated(string $sensorId, \DateTimeImmutable $from, \DateTimeImmutable $to): array
    {
        $days     = (int) $from->diff($to)->days;
        $cacheKey = sprintf('range_%s_%s_%s', $sensorId, $from->format('Y-m-d'), $to->format('Y-m-d'));

        return $this->cacheMeasurements->get($cacheKey, function (ItemInterface $item) use ($sensorId, $from, $to, $days) {
            $item->expiresAfter(1800); // 30 min

            if ($days <= 3) {
                $groupExpr  = 'DATE(m.created_at), HOUR(m.created_at)';
                $selectTime = 'MIN(m.created_at) AS createdAt';
            } elseif ($days <= 14) {
                $groupExpr  = 'DATE(m.created_at), FLOOR(HOUR(m.created_at) / 4)';
                $selectTime = 'MIN(m.created_at) AS createdAt';
            } elseif ($days <= 60) {
                $groupExpr  = 'DATE(m.created_at)';
                $selectTime = 'DATE(m.created_at) AS createdAt';
            } else {
                $groupExpr  = 'YEARWEEK(m.created_at, 1)';
                $selectTime = 'MIN(m.created_at) AS createdAt';
            }

            $sql = "
                SELECT
                    ROUND(AVG(m.pm10)) AS pm10,
                    ROUND(AVG(m.pm25)) AS pm25,
                    {$selectTime}
                FROM measurement m
                WHERE m.sensor_id = :sensorId
                  AND m.created_at >= :from
                  AND m.created_at <= :to
                GROUP BY {$groupExpr}
                ORDER BY {$groupExpr} ASC
            ";

            return $this->getEntityManager()
                ->getConnection()
                ->executeQuery($sql, [
                    'sensorId' => $sensorId,
                    'from'     => $from->format('Y-m-d H:i:s'),
                    'to'       => $to->format('Y-m-d H:i:s'),
                ])
                ->fetchAllAssociative();
        });
    }
}
