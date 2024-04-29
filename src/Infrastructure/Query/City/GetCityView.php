<?php

namespace App\Infrastructure\Query\City;

use App\Domain\Repository\CityRepositoryInterface;
use App\Domain\View\City\CityView;

readonly class GetCityView implements GetCityViewInterface
{
    public function __construct(
        private CityRepositoryInterface $cityRepository
    ) {
    }

    public function execute(int $id): CityView
    {
        $city = $this->cityRepository->find($id);
        return CityView::fromEntity($city);
    }
}
