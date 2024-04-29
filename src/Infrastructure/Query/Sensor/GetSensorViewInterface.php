<?php

namespace App\Infrastructure\Query\Sensor;

use App\Domain\View\Sensor\SensorView;

interface GetSensorViewInterface
{
    public function execute(
        int $id
    ): SensorView;
}
