<?php

namespace App\Domain\View\Sensor;

use App\Domain\Entity\City;
use App\Domain\Entity\Sensor;

class SensorView
{
    private ?int $id;
    private ?string $name;
    private ?string $cityName;
    private ?string $address;
    private ?array $measurements;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?string $cityName = null,
        ?string $address = null,
        ?array $measurements = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->cityName = $cityName;
        $this->address = $address;
        $this->measurements = $measurements;
    }

    public static function fromEntity(Sensor $sensor): self
    {
        return new self(
            $sensor->getId(),
            $sensor->getName(),
            $sensor->getCity()->getName(),
            $sensor->getAddress(),
            null
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    public function setCityName(?string $cityName): void
    {
        $this->cityName = $cityName;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getMeasurements(): ?array
    {
        return $this->measurements;
    }

    public function setMeasurements(?array $measurements): void
    {
        $this->measurements = $measurements;
    }
}
