<?php

namespace App\Application\Command\Sensor;

use App\Application\Service\CQRS\Command\CommandHandlerInterface;
use App\Application\Service\Sensor\CreateSensorService;
use App\Application\Service\Sensor\UpdateSensorService;
use App\Domain\Repository\SensorRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

readonly class RemoveSensorCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SensorRepositoryInterface $sensorRepository,
        private EntityManagerInterface $em
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke(RemoveSensorCommand $command): void
    {
        $sensor = $this->sensorRepository->findOneBy(['id' => $command->getId()]);
        if ($sensor) {
            $this->em->remove($sensor);
            $this->em->flush();
        } else {
            throw new EntityNotFoundException();
        }
    }
}
