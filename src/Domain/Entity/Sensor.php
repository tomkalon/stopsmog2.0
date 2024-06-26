<?php

namespace App\Domain\Entity;

use App\Domain\Trait\IdTrait;
use App\Domain\Trait\LifecycleTrait;
use Doctrine\Common\Collections\Collection;

class Sensor
{
    use IdTrait;
    use LifecycleTrait;

    private string $name;
    private City $city;
    private string $address;
    private string $description;
    private int $positionX = 0;
    private int $positionY = 0;
    private Collection $measurements;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function setCity(City $city): void
    {
        $this->city = $city;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPositionX(): int
    {
        return $this->positionX;
    }

    public function setPositionX(int $positionX): void
    {
        $this->positionX = $positionX;
    }

    public function getPositionY(): int
    {
        return $this->positionY;
    }

    public function setPositionY(int $positionY): void
    {
        $this->positionY = $positionY;
    }

    public function getMeasurements(): Collection
    {
        return $this->measurements;
    }

    public function setMeasurements(Collection $measurements): void
    {
        $this->measurements = $measurements;
    }
}
