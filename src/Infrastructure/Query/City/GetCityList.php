<?php

namespace App\Infrastructure\Query\City;

use App\Domain\Entity\City;
use App\Domain\Repository\CityRepositoryInterface;
use App\Domain\View\City\CityView;
use Doctrine\Common\Collections\Collection;

readonly class GetCityList implements GetCityListInterface
{
    public function __construct(
        private CityRepositoryInterface $cityRepository
    ) {
    }

    public function execute(): array
    {
        /** @var City|Collection $cityList */
        $cityList = $this->cityRepository->listAll();
        $cityViewList = [];
        foreach ($cityList as $city) {
            $cityViewList[] = CityView::fromEntity($city);
        }
        return $cityViewList;
    }
}
