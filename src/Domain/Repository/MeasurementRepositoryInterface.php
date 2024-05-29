<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Measurement;
use App\Domain\Filter\Sensor\SensorFilter;

/**
 * @method Measurement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Measurement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Measurement[]    findAll()
 * @method Measurement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface MeasurementRepositoryInterface
{
    public function getSensorMeasurementsByFilter(string $sensorId, SensorFilter $sensorFilter): array;
}
