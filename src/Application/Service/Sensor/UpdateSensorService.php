<?php

namespace App\Application\Service\Sensor;

use App\Domain\View\Sensor\SensorView;

readonly class UpdateSensorService extends PersistSensorAbstractService
{
    public function save(SensorView $sensorView): void
    {
        $sensor = $this->getEntity($sensorView);
        if ($sensorView->getName()) {
            $sensor->setName($sensorView->getName());
        }

        if ($sensorView->getCity()) {
            $sensor->setCity($sensorView->getCity());
        }

        if ($sensorView->getAddress()) {
            $sensor->setAddress($sensorView->getAddress());
        }

        $this->persist($sensor);
    }
}
