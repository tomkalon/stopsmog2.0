<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Sensor;
use App\Domain\Filter\Sensor\SensorFilter;

/**
 * @method Sensor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sensor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sensor[]    findAll()
 * @method Sensor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface SensorRepositoryInterface
{
    public function listAll(?SensorFilter $filter = null): array;
    public function getSensorWithFilter(int $id, ?SensorFilter $filter): Sensor;

}
