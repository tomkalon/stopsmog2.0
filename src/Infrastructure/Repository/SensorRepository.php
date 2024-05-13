<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\SensorRepositoryInterface;
use App\Domain\Entity\Sensor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SensorRepository extends ServiceEntityRepository implements SensorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sensor::class);
    }


    public function listAll(?array $sort = null, ?array $filter = null): array
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->addSelect('city')
            ->leftJoin('s.city', 'city');

        if (!$filter) {
            $qb
                ->addSelect('measurements')
                ->leftJoin('s.measurements',
                    'measurements',
                    'WITH',
                    'measurements.id = (SELECT MAX(m.id) FROM App\Domain\Entity\Measurement m WHERE m.sensor = measurements.sensor)');
        }

        return $qb->getQuery()->getResult();
    }
}
