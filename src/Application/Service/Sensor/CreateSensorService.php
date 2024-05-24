<?php

namespace App\Application\Service\Sensor;

use App\Domain\Entity\Sensor;
use App\Domain\View\Sensor\SensorView;

readonly class CreateSensorService extends PersistSensorAbstractService
{
    public function save(SensorView $sensorView): void
    {
        $sensor = new Sensor();
        $sensor->setName($sensorView->getName());
        $sensor->setCity($sensorView->getCity());
        $sensor->setAddress($sensorView->getAddress());
        $sensor->setPositionX($sensorView->getPositionX() ?? $sensor->getPositionX());
        $sensor->setPositionY($sensorView->getPositionY() ?? $sensor->getPositionY());

        $this->persist($sensor);
    }
}
