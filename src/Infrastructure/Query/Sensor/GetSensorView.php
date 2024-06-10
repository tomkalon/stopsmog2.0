<?php

namespace App\Infrastructure\Query\Sensor;

use App\Domain\Entity\Measurement;
use App\Domain\Filter\Sensor\SensorFilter;
use App\Domain\Repository\MeasurementRepositoryInterface;
use App\Domain\Repository\SensorRepositoryInterface;
use App\Domain\View\Measurement\MeasurementView;
use App\Domain\View\Sensor\SensorView;

readonly class GetSensorView implements GetSensorViewInterface
{
    public function __construct(
        private SensorRepositoryInterface      $sensorRepository,
        private MeasurementRepositoryInterface $measurementRepository
    ) {
    }

    public function execute(int $id, ?SensorFilter $sensorFilter = null): SensorView
    {
        $sensor = $this->sensorRepository->find($id);
        $sensorView = SensorView::fromEntity($sensor);

        if ($sensorFilter) {
            /** @var Measurement[] $measurements */
            $measurements = $this->measurementRepository->getSensorMeasurementsByFilter(
                $id,
                $sensorFilter
            );

            /** @var MeasurementView[] $measurementsView */
            $measurementsView = [];
            foreach ($measurements as $measurement) {
                $measurementsView[] = MeasurementView::fromEntity($measurement);
            }
            $sensorView->setMeasurements($measurementsView);
        }

        return $sensorView;
    }
}
