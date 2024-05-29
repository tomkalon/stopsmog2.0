<?php

namespace App\Infrastructure\Query\Sensor;

use App\Domain\Filter\Sensor\SensorFilter;
use App\Domain\Repository\SensorRepositoryInterface;
use App\Domain\View\Sensor\SensorView;

readonly class GetSensorView implements GetSensorViewInterface
{
    public function __construct(
        private SensorRepositoryInterface $sensorRepository
    ) {
    }

    public function execute(int $id, ?SensorFilter $sensorFilter = null): SensorView
    {
        $sensor = null;
        if (!$sensorFilter) {
            $sensor = $this->sensorRepository->find($id);
        } else {
            $sensor = $this->sensorRepository->getSensorWithFilter($id, $sensorFilter);
        }
        return SensorView::fromEntity($sensor);
    }
}
