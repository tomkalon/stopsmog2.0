<?php

namespace App\Domain\Filter\Sensor;

class SensorFilter
{
    public ?bool $single_measurement = false;

    public ?int $cityId = null;

    public function __construct(
        ?bool $single_measurement = false,
        ?int $cityId = null
    )
    {
        $this->single_measurement = $single_measurement;
        $this->cityId = $cityId;
    }
}
