<?php

namespace App\Domain\Entity;

class FileSettings extends File
{
    private ?Settings $map_image;

    public function getMapImage(): ?Settings
    {
        return $this->map_image;
    }

    public function setMapImage(?Settings $map_image): void
    {
        $this->map_image = $map_image;
    }
}
