<?php

namespace App\Infrastructure\DataFixtures\Sensor;

use App\Domain\Entity\Sensor;

interface GenerateSensorFixturesInterface
{
    public function getSensor(array $cityList): ?Sensor;
}
