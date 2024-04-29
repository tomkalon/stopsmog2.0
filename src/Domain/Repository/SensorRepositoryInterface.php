<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Sensor;

/**
 * @method Sensor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sensor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sensor[]    findAll()
 * @method Sensor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface SensorRepositoryInterface
{
    public function listAll(?array $sort = null, ?array $filter = null): array;
}
