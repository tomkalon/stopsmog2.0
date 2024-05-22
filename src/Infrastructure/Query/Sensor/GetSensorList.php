<?php

namespace App\Infrastructure\Query\Sensor;

use App\Domain\Entity\Sensor;
use App\Domain\Filter\Sensor\SensorFilter;
use App\Domain\Repository\SensorRepositoryInterface;
use App\Domain\View\Sensor\SensorView;
use Doctrine\Common\Collections\Collection;

readonly class GetSensorList implements GetSensorListInterface
{
    public function __construct(
        private SensorRepositoryInterface $sensorRepository
    ) {
    }

    public function execute(?SensorFilter $filter = null): array
    {
        /** @var Sensor|Collection $sensorList */
        $sensorList = $this->sensorRepository->listAll($filter);
        $sensorViewList = [];

        /**
         * @var int $index
         * @var Sensor $sensor
         */

        foreach ($sensorList as $index => $sensor) {
            $sensorViewList[$index] = SensorView::fromEntity($sensor);

            if ($filter) {
                if ($filter->single_measurement) {
                    $sensorViewList[$index]->setMeasurements([$sensor->getMeasurements()->last()]);
                } else {
                    $sensorViewList[$index]->setMeasurements($sensor->getMeasurements()->toArray());
                }
            }
        }
        return $sensorViewList;
    }
}
