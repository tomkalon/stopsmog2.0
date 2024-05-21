<?php

namespace App\Application\Command\Settings;

use App\Application\Service\CQRS\Command\CommandHandlerInterface;
use App\Application\Service\File\ImageUploadInterface;
use App\Application\Service\Settings\UpdateSettingsInterface;
use App\Domain\Enum\FileExtensionEnum;

readonly class SettingsCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ImageUploadInterface $imageUpload,
        private UpdateSettingsInterface $updateSettings
    )
    {
    }

    public function __invoke(SettingsCommand $command)
    {
        $settingsView = $command->getSettingsView();
        $uploadedFile = $settingsView->getUploadedFile();

        $mapImageVO = null;
        if ($uploadedFile) {
            $mapImageVO = $this->imageUpload->upload($uploadedFile, FileExtensionEnum::WEBP);
        }

        $this->updateSettings->persist($settingsView, $mapImageVO);
    }
}
