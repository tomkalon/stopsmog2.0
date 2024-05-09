<?php

namespace App\Domain\Entity;


namespace App\Domain\Entity;

use App\Domain\Trait\LifecycleTrait;

class Settings
{
    use LifecycleTrait;

    private string $id = 'settings';
    private ?File $mapImage = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getMapImage(): ?File
    {
        return $this->mapImage;
    }

    public function setMapImage(?File $mapImage): void
    {
        $this->mapImage = $mapImage;
    }
}
