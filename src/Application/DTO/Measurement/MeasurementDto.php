<?php

namespace App\Application\DTO\Measurement;

class MeasurementDto
{
    private int $pm10;
    private string $createdAt;

    public function __construct(
        int $pm10,
        string $createdAt
    ) {
        $this->pm10 = $pm10;
        $this->createdAt = $createdAt;
    }

    public function pm10(): int
    {
        return $this->pm10;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }
}
