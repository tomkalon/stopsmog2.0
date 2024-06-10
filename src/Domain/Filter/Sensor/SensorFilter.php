<?php

namespace App\Domain\Filter\Sensor;

use DateTimeImmutable;

class SensorFilter
{
    public ?bool $single_measurement = false;
    public ?int $cityId = null;
    public ?DateTimeImmutable $timePeriodStart = null;
    public ?DateTimeImmutable $timePeriodEnd = null;

    public function __construct(
        ?bool $single_measurement = false,
        ?int $cityId = null,
        ?DateTimeImmutable $timePeriodStart = null,
        ?DateTimeImmutable $timePeriodEnd = null
    ) {
        $this->single_measurement = $single_measurement;
        $this->cityId = $cityId;
        $this->timePeriodStart = $timePeriodStart;
        $this->timePeriodEnd = $timePeriodEnd;
    }
}
