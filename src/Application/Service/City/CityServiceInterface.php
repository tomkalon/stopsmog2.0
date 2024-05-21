<?php

namespace App\Application\Service\City;

use App\Domain\View\City\CityView;

interface CityServiceInterface
{
    public function save(CityView $cityView): void;
}
