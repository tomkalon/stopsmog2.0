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

    public function getMeasurements(): Collection
    {
        return $this->measurements;
    }

    public function setMeasurements(Collection $measurements): void
    {
        $this->measurements = $measurements;
    }
}
