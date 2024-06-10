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
}
