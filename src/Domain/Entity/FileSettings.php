<?php

namespace App\Domain\Entity;

class FileSettings extends File
{
    private ?Settings $settings;

    public function getSettings(): ?Settings
    {
        return $this->settings;
    }

    public function setSettings(?Settings $settings): void
    {
        $this->settings = $settings;
    }
}
