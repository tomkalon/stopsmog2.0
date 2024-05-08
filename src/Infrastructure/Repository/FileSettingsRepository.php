<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\FileSettingsRepositoryInterface;
use App\Domain\Entity\FileSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FileSettingsRepository extends ServiceEntityRepository implements FileSettingsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileSettings::class);
    }
}
