<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\FileCityRepositoryInterface;
use App\Domain\Entity\FileCity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FileCityRepository extends ServiceEntityRepository implements FileCityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileCity::class);
    }
}
