<?php

namespace App\Application\Service\Sensor;

use App\Domain\Entity\Sensor;
use App\Domain\Repository\SensorRepositoryInterface;
use App\Domain\View\Sensor\SensorView;
use Doctrine\ORM\EntityManagerInterface;

abstract readonly class PersistSensorAbstractService
{
    public function __construct(
        private EntityManagerInterface $em,
        private SensorRepositoryInterface $sensorRepository
    )
    {
    }
    abstract function save(SensorView $sensorView);

    protected function getEntity(SensorView $sensorView): Sensor
    {
        return $this->sensorRepository->findOneBy(['id' => $sensorView->getId()]);
    }

    protected function persist(Sensor $sensor): void
    {
        $this->em->persist($sensor);
    }
}
