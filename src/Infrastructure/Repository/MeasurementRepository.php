<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Measurement;
use App\Domain\Filter\Sensor\SensorFilter;
use App\Domain\Repository\MeasurementRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MeasurementRepository extends ServiceEntityRepository implements MeasurementRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
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
    }

    public function getMonthlyAggregated(string $sensorId): array
    {
        $monthStart = new \DateTimeImmutable('30 days ago midnight');

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
    }
}
