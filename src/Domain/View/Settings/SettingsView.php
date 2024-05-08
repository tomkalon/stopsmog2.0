<?php

namespace App\Domain\View\Settings;

use App\Domain\Entity\FileSettings;
use App\Domain\Entity\Settings;

class SettingsView
{
    private ?FileSettings $mapImage;

    public function __construct(
        ?FileSettings $mapImage = null
    )
    {
        $this->mapImage = $mapImage;
    }

    public static function fromEntity(Settings $settings): self
    {
        return new self(
            $settings->getMapImage()
        );
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
