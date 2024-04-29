<?php

namespace App\Application\Service\City;

use App\Domain\View\City\CityView;

readonly class UpdateCityService extends PersistCityAbstractService
{
    public function save(CityView $cityView): void
    {
        $city = $this->getEntity($cityView);
        if ($cityView->getName()) {
            $city->setName(($cityView->getName()));
        }

        $this->persist($city);
    }
}
