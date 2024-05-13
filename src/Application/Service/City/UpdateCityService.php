<?php

namespace App\Application\Service\City;

use App\Domain\View\City\CityView;

readonly class UpdateCityService extends PersistCityAbstractService
{
    public function save(CityView $cityView): void
    {
        $city = $this->getEntity($cityView);
        $city->setName($cityView->getName() ?: $city->getName());
        $city->setPositionX($cityView->getPositionX() ?: $city->getPositionX());
        $city->setPositionY($cityView->getPositionY() ?: $city->getPositionY());

        $this->persist($city);
    }
}
