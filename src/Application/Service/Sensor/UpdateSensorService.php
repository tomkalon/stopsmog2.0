<?php

namespace App\Application\Service\Sensor;

use App\Domain\View\Sensor\SensorView;

readonly class UpdateSensorService extends PersistSensorAbstractService
{
    public function save(SensorView $sensorView): void
    {
        $sensor = $this->getEntity($sensorView);
        $sensor->setName($sensorView->getName() ?? $sensor->getName());
        $sensor->setCity($sensorView->getCity() ?? $sensor->getCity());
        $sensor->setAddress($sensorView->getAddress() ?? $sensor->getAddress());
        $sensor->setPositionX($sensorView->getPositionX() ?? $sensor->getPositionX());
        $sensor->setPositionY($sensorView->getPositionY() ?? $sensor->getPositionY());

        $this->persist($sensor);
    }
}
