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

        if ($sensorFilter->timePeriod) {
            $qb
                ->andWhere('m.createdAt >= :timePeriod')
                ->setParameter('timePeriod', $sensorFilter->timePeriod);
        }

        return $qb->getQuery()->getResult();
    }
}
