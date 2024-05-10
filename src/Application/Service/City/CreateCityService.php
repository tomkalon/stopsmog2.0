<?php

namespace App\Application\Service\City;

use App\Domain\Entity\City;
use App\Domain\View\City\CityView;

readonly class CreateCityService extends PersistCityAbstractService
{
    public function save(CityView $cityView): void
    {
        $city = new City();
        $city->setName($cityView->getName());
        $city->setPositionX($cityView->getPositionX());
        $city->setPositionY($cityView->getPositionY());
        $this->persist($city);
    }
}
