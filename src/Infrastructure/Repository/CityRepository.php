<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\CityRepositoryInterface;
use App\Domain\Entity\City;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CityRepository extends ServiceEntityRepository implements CityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, City::class);
    }

    public function listAll(): array
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->addSelect('sensors')
            ->leftJoin('c.sensors', 'sensors')
            ->addSelect('measurements')
            ->leftJoin('sensors.measurements',
                'measurements',
                'WITH',
                'measurements.id = (SELECT MAX(m.id) FROM App\Domain\Entity\Measurement m WHERE m.sensor = measurements.sensor)');

        return $qb->getQuery()->getResult();
    }
}
