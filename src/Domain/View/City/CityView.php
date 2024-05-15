<?php

namespace App\Domain\View\City;

use App\Domain\Entity\City;

class CityView
{
    private ?int $id;
    private ?string $name;
    private ?int $positionX;
    private ?int $positionY;
    private array $sensors;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?int $positionX = null,
        ?int $positionY = null,
        array $sensors = [],
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->sensors = $sensors;
    }

    public static function fromEntity(City $city): self
    {
        return new self(
            $city->getId(),
            $city->getName(),
            $city->getPositionX(),
            $city->getPositionY(),
            $city->getSensors()->toArray(),
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

    public function getPositionX(): ?int
    {
        return $this->positionX;
    }

    public function setPositionX(?int $positionX): void
    {
        $this->positionX = $positionX;
    }

    public function getPositionY(): ?int
    {
        return $this->positionY;
    }

    public function setPositionY(?int $positionY): void
    {
        $this->positionY = $positionY;
    }

    public function getSensors(): array
    {
        return $this->sensors;
    }

    public function setSensors(array $sensors): void
    {
        $this->sensors = $sensors;
    }
}
