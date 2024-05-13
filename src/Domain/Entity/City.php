<?php

namespace App\Domain\Entity;

use App\Domain\Trait\IdTrait;
use App\Domain\Trait\LifecycleTrait;
use Doctrine\Common\Collections\Collection;

class City
{
    use IdTrait;
    use LifecycleTrait;

    private string $name;
    private int $positionX = 0;
    private int $positionY = 0;
    private Collection $sensors;


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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

    public function getSensors(): Collection
    {
        return $this->sensors;
    }

    public function setSensors(Collection $sensors): void
    {
        $this->sensors = $sensors;
    }
}
