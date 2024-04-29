<?php

namespace App\Infrastructure\DataFixtures\Measurement;

use App\Domain\Entity\Measurement;
use App\Domain\Entity\Sensor;

interface GenerateMeasurementFixturesInterface
{
    public function addMeasurement(Sensor $sensor, int $count, int $interval): void;
}
