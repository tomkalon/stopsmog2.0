<?php

namespace App\Domain\Entity;

class FileSettings extends File
{
    private ?Settings $settings_image;

    public function getSettingsImage(): ?Settings
    {
        return $this->settings_image;
    }

    public function setSettingsImage(?Settings $settings_image): void
    {
        $this->settings_image = $settings_image;
    }
}
