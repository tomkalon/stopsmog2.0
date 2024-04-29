<?php

namespace App\Application\Command\Sensor;

use App\Application\Service\CQRS\Command\CommandHandlerInterface;
use App\Application\Service\Sensor\CreateSensorService;
use App\Application\Service\Sensor\UpdateSensorService;
use Exception;

readonly class SensorCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private CreateSensorService $createSensorService,
        private UpdateSensorService $updateSensorService
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke(SensorCommand $command): void
    {
        $sensorView = $command->getSensorView();
        if ($sensorView->getId()) {
            $this->updateSensorService->save($sensorView);
        } else {
            $this->createSensorService->save($sensorView);
        }
    }
}
