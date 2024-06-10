<?php

namespace App\Domain\View\Measurement;

use App\Domain\Entity\Measurement;
use DateTimeImmutable;

class MeasurementView
{
    private ?string $pm10;
    private ?string $pm25;
    private ?DateTimeImmutable $createdAt;

    public function __construct(
        ?string            $pm10,
        ?string            $pm25,
        ?DateTimeImmutable $createdAt = null
    ) {
        $this->pm10 = $pm10;
        $this->pm25 = $pm25;
        $this->createdAt = $createdAt;
    }

    public static function fromEntity(Measurement $measurement): self
    {
        return new self(
            $measurement->getPm10(),
            $measurement->getPm25(),
            $measurement->getCreatedAt()
        );
    }

    public function getPm10(): ?string
    {
        return $this->pm10;
    }

    public function setPm10(?string $pm10): void
    {
        $this->pm10 = $pm10;
    }

    public function getPm25(): ?string
    {
        return $this->pm25;
    }

    public function setPm25(?string $pm25): void
    {
        $this->pm25 = $pm25;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
