<?php

namespace App\Application\DTO\Sensor;

use App\Application\DTO\Measurement\MeasurementDto;

class SensorDto
{
    private ?int $sensorId;

    /** @var MeasurementDto[] $measurements */
    private ?array $measurements;

    public function __construct(
        ?int $sensorId,
        ?array $measurements
    ) {
        $this->sensorId = $sensorId;
        $this->measurements = $measurements;
    }

    public function sensorId(): ?int
    {
        return $this->sensorId;
    }

    public function measurement(): ?array
    {
        return $this->measurements;
    }
}
