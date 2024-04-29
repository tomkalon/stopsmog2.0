<?php

namespace App\Infrastructure\Query\Sensor;

use App\Domain\Entity\Sensor;
use App\Domain\Repository\SensorRepositoryInterface;
use App\Domain\View\Sensor\SensorView;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

readonly class GetSensorList implements GetSensorListInterface
{
    public function __construct(
        private SensorRepositoryInterface $sensorRepository
    ) {
    }

    public function execute(?array $sort = null, ?array $filter = null): array
    {
        /** @var Sensor|Collection $sensorList */
        $sensorList = $this->sensorRepository->listAll();
        $sensorViewList = [];

        /**
         * @var int $index
         * @var Sensor $sensor
         */
        foreach ($sensorList as $index => $sensor) {
            $sensorViewList[$index] = SensorView::fromEntity($sensor);
            if (!$filter) {
                $sensorViewList[$index]->setMeasurements(
                    [$sensor->getMeasurements()->last()]
                );
            }
        }
        return $sensorViewList;
    }
}
