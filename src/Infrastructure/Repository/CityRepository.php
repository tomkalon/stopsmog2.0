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
            ->leftJoin('c.sensors', 'sensors');

        return $qb->getQuery()->getResult();
    }
}
