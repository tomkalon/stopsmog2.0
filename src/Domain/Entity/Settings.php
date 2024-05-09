<?php

namespace App\Domain\Entity;


namespace App\Domain\Entity;

use App\Domain\Trait\LifecycleTrait;

class Settings
{
    use LifecycleTrait;

    private string $id = 'settings';
    private ?FileSettings $mapImage = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getMapImage(): ?FileSettings
    {
        return $this->mapImage;
    }

    public function setMapImage(?FileSettings $mapImage): void
    {
        $this->mapImage = $mapImage;
    }
}
