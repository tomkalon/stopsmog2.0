<?php

namespace App\Domain\Entity;

class FileSensor extends File
{
    private ?Sensor $image;

    public function getImage(): ?Sensor
    {
        return $this->image;
    }

    public function setImage(?Sensor $image): void
    {
        $this->image = $image;
    }
}
