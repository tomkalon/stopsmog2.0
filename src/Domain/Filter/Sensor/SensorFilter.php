<?php

namespace App\Domain\Filter\Sensor;

use App\Domain\Enum\PeriodEnum;

class SensorFilter
{
    public ?bool $single_measurement = false;
    public ?int $cityId = null;
    public ?int $periodNumber = null;

    public function __construct(
        ?bool $single_measurement = false,
        ?int $cityId = null,
        ?int $periodNumber = null
    ) {
        $this->single_measurement = $single_measurement;
        $this->cityId = $cityId;
        $this->periodNumber = $periodNumber;
    }
}
