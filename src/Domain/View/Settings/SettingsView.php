<?php

namespace App\Domain\View\Settings;

use App\Domain\Entity\File;
use App\Domain\Entity\Settings;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SettingsView
{
    private ?File $mapImage;
    private ?UploadedFile $uploadedFile;

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

    public function getUploadedFile(): ?UploadedFile
    {
        return $this->uploadedFile;
    }

    public function setUploadedFile(?UploadedFile $uploadedFile): void
    {
        $this->uploadedFile = $uploadedFile;
    }
}
