<?php

namespace App\Infrastructure\DataFixtures\City;

use App\Domain\Entity\City;
use App\Domain\Repository\CityRepositoryInterface;

readonly class GenerateCityFixtures implements GenerateCityFixturesInterface
{
    public function __construct(
        private CityRepositoryInterface $cityRepository
    ) {
    }

    public function getCity(): ?City
    {
        $cityNames = [
            'Borek',
            'Bratucice',
            'Buczków',
            'Dąbrówka',
            'Dębina',
            'Jodłówka',
            'Krzeczów',
            'Łazy',
            'Okulice',
            'Ostrów Królewski',
            'Rzezawa'
        ];

        $name = $cityNames[array_rand($cityNames)];

        if ($this->cityRepository->findBy(['name' => $name])) {
            return null;
        } else {
            $city = new City();
            $city->setName($name);
            return $city;
        }
    }
}
