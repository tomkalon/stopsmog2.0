<?php

namespace App\Domain\View\Settings;

use App\Domain\Entity\File;
use App\Domain\Entity\Settings;

class SettingsView
{
    private ?File $mapImage;

    public function __construct(
        ?File $mapImage = null
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

    public function getMapImage(): ?File
    {
        return $this->mapImage;
    }

    public function setMapImage(?File $mapImage): void
    {
        $this->mapImage = $mapImage;
    }

    public function getMapImageFilename(): ?string
    {
        return $this->mapImage->getFilename();
    }
}
