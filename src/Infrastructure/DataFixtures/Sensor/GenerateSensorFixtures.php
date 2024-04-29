<?php

namespace App\Infrastructure\DataFixtures\Sensor;

use App\Domain\Entity\City;
use App\Domain\Entity\Sensor;
use App\Domain\Repository\SensorRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;

readonly class GenerateSensorFixtures implements GenerateSensorFixturesInterface
{
    public function __construct(
        private SensorRepositoryInterface $cityRepository,
    ) {
    }

    /**
     * @var ArrayCollection|City[] $cityList
     */
    public function getSensor(array $cityList): ?Sensor
    {
        $sensorNames = [
            'Szkoła',
            'Przedszkole',
            'Ośrodek Zdrowia',
            'Świetlica',
            'Urząd',
            'Bank',
            'Kościół',
        ];

        $addressesNames = [
            'ul. Koperkowa 12',
            'ul. Kniazia Knura 5',
            'al. Alfreda Niziołka 8',
            'ul. Mózgowa 81',
            'ul. Krecia 5',
            'pl. Jaszczurek i Nornic 5',
            'ul. Cara Mariusza',
        ];

        $sensorName = $sensorNames[array_rand($sensorNames)];
        $addressName = $addressesNames[array_rand($addressesNames)];
        $cityName = $cityList[array_rand($cityList)];

        $sensorQuery = $this->cityRepository->findBy([
            'name' => $sensorName,
            'city' => $cityName
        ]);

        if ($sensorQuery) {
            return null;
        } else {
            $sensor = new Sensor();
            $sensor->setName($sensorName);
            $sensor->setAddress($addressName);
            $sensor->setCity($cityName);
            return $sensor;
        }
    }
}
