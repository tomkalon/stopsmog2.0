<?php

namespace App\Infrastructure\Query\Sensor;

use App\Domain\Repository\SensorRepositoryInterface;
use App\Domain\View\Sensor\SensorView;

readonly class GetSensorView implements GetSensorViewInterface
{
    public function __construct(
        private SensorRepositoryInterface $sensorRepository
    ) {
    }

    public function execute(int $id): SensorView
    {
        $sensor = $this->sensorRepository->find($id);
        return SensorView::fromEntity($sensor);
    }
}
