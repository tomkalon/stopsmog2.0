<?php

namespace App\Infrastructure\Query\Sensor;

use DateTimeImmutable;

interface GetSensorListInterface
{
    public function execute(?array $sort = null, ?array $filter = null): array;
}
