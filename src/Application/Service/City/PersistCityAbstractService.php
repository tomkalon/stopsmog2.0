<?php

namespace App\Application\Service\City;

use App\Domain\Entity\City;
use App\Domain\Repository\CityRepositoryInterface;
use App\Domain\View\City\CityView;
use Doctrine\ORM\EntityManagerInterface;

abstract readonly class PersistCityAbstractService
{
    public function __construct(
        private EntityManagerInterface $em,
        private CityRepositoryInterface $sensorRepository
    )
    {
    }

    abstract function save(CityView $cityView);
    protected function getEntity(CityView $cityView): City
    {
        return $this->sensorRepository->findOneBy(['id' => $cityView->getId()]);
    }

    protected function persist(City $city): void
    {
        $this->em->persist($city);
    }
}
