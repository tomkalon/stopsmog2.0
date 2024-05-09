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
        $mapImage = $command->getMapImage();

        $mapImageVO = null;
        if ($mapImage) {
            $mapImageVO = $this->imageUpload->upload($mapImage, FileExtensionEnum::WEBP);
        }

        $this->updateSettings->persist($settingsView, $mapImageVO);
    }
}
