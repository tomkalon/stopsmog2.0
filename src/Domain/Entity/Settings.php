<?php

namespace App\Domain\Entity;


namespace App\Domain\Entity;

use App\Domain\Trait\LifecycleTrait;

class Settings
{
    use LifecycleTrait;

    private string $id = 'settings';
    private ?FileSettings $map_image = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getMapImage(): ?FileSettings
    {
        return $this->map_image;
    }

    public function setMapImage(?FileSettings $map_image): void
    {
        $this->map_image = $map_image;
    }
}
