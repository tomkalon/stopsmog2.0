<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Entity\City;
use App\Domain\Entity\Sensor;
use App\Infrastructure\DataFixtures\City\GenerateCityFixturesInterface;
use App\Infrastructure\DataFixtures\Measurement\GenerateMeasurementFixturesInterface;
use App\Infrastructure\DataFixtures\Sensor\GenerateSensorFixturesInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const NUMBER_OF_CITIES = 3;
    const NUMBER_OF_SENSORS = 6;
    const MEASUREMENTS_PER_SENSOR = 1000;
    const MEASUREMENTS_INTERVAL = 60; // in minutes

    public function __construct(
        private readonly GenerateCityFixturesInterface        $cityFixtures,
        private readonly GenerateSensorFixturesInterface      $sensorFixtures,
        private readonly GenerateMeasurementFixturesInterface $measurementFixtures
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        /**
         * @var Collection|City[] $citiesList
         */
        $citiesList = [];
        /**
         * @var Collection|Sensor[] $sensorsList
         */
        $sensorsList = [];

        // GENERATE CITY LIST
        for ($i = 0; $i < self::NUMBER_OF_CITIES; $i++) {
            $city = $this->cityFixtures->getCity();
            if ($city) {
                $citiesList[] = $city;
                $manager->persist($city);
                $manager->flush();
            }
        }

        // GENERATE SENSORS LIST
        for ($i = 0; $i < self::NUMBER_OF_SENSORS; $i++) {
            $sensor = $this->sensorFixtures->getSensor($citiesList);
            if ($sensor) {
                $sensorsList[] = $sensor;
                $manager->persist($sensor);
                $manager->flush();
            }
        }

        // GENERATE MEASUREMENTS
        foreach ($sensorsList as $sensor) {
            $this->measurementFixtures->addMeasurement($sensor, self::MEASUREMENTS_PER_SENSOR, self::MEASUREMENTS_INTERVAL);
        }
    }
}
