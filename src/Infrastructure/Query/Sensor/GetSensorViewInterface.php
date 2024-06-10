<?php

namespace App\Infrastructure\Query\Sensor;

use App\Domain\Filter\Sensor\SensorFilter;
use App\Domain\View\Sensor\SensorView;

interface GetSensorViewInterface
{
    public function execute(
        int $id,
        ?SensorFilter $sensorFilter = null
    ): SensorView;
}
