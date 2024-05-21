<?php

namespace App\Infrastructure\Query\Sensor;

use App\Domain\Filter\Sensor\SensorFilter;
use DateTimeImmutable;

interface GetSensorListInterface
{
    public function execute(?SensorFilter $filter = null): array;
}
