<?php

namespace App\Infrastructure\Repository;

use App\Domain\Filter\Sensor\SensorFilter;
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


    public function listAll(?SensorFilter $filter = null): array
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->addSelect('city')
            ->leftJoin('s.city', 'city');

        if ($filter) {
            if ($filter->cityId) {
                $qb
                    ->andWhere('city.id = :cityId')
                    ->setParameter('cityId', $filter->cityId);
            }
        }

        return $qb->getQuery()->getResult();
    }

    public function getSensorWithFilter(int $id, ?SensorFilter $filter): Sensor
    {
        $qb = $this->createQueryBuilder('s');
        $qb->where('s.id = :id')
            ->setParameter('id', $id);

        if ($filter) {
            if ($filter->periodNumber) {

            }
        }

        return $qb->getQuery()->getResult();
    }
}
