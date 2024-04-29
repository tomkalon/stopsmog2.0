<?php

namespace App\Application\Command\Sensor;

use App\Application\Service\CQRS\Command\CommandInterface;
use App\Domain\View\Sensor\SensorView;

readonly class SensorCommand implements CommandInterface
{
    public function __construct(
        private SensorView $sensorView
    )
    {
    }

    public function getSensorView(): SensorView
    {
        return $this->sensorView;
    }
}
