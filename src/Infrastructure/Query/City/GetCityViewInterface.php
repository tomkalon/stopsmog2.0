<?php

namespace App\Infrastructure\Query\City;


use App\Domain\View\City\CityView;

interface GetCityViewInterface
{
    public function execute(
        int $id
    ): CityView;
}
