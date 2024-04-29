<?php

namespace App\Domain\Entity;

use App\Domain\Trait\IdTrait;
use DateTimeImmutable;

class Measurement
{
    use IdTrait;

    private ?int $pm10;
    private ?int $pm25;
    private Sensor $sensor;
    private DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getPm10(): ?int
    {
        return $this->pm10;
    }

    public function setPm10(?int $pm10): void
    {
        $this->pm10 = $pm10;
    }

    public function getPm25(): ?int
    {
        return $this->pm25;
    }

    public function setPm25(?int $pm25): void
    {
        $this->pm25 = $pm25;
    }

    public function getSensor(): Sensor
    {
        return $this->sensor;
    }

    public function setSensor(Sensor $sensor): void
    {
        $this->sensor = $sensor;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
