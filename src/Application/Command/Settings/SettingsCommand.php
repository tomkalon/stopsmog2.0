<?php

namespace App\Application\Command\Settings;

use App\Application\Service\CQRS\Command\CommandInterface;
use App\Domain\View\Settings\SettingsView;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SettingsCommand implements CommandInterface
{
    public function __construct(
        private readonly SettingsView $settingsView,
        private readonly ?UploadedFile $mapImage

    ) {
    }

    public function getSettingsView(): SettingsView
    {
        return $this->settingsView;
    }

    public function getMapImage(): ?UploadedFile
    {
        return $this->mapImage;
    }
}
