<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\FileSensorRepositoryInterface;
use App\Domain\Entity\FileSensor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FileSensorRepository extends ServiceEntityRepository implements FileSensorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileSensor::class);
    }
}
