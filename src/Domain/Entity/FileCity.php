<?php

namespace App\Domain\Entity;

class FileCity extends File
{
    private ?City $image;

    public function getImage(): ?City
    {
        return $this->image;
    }

    public function setImage(?City $image): void
    {
        $this->image = $image;
    }
}
