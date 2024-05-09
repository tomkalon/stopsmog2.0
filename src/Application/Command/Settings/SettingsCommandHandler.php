<?php

namespace App\Application\Command\Settings;

use App\Application\Service\CQRS\Command\CommandHandlerInterface;
use App\Application\Service\File\ImageUploadInterface;
use App\Domain\Enum\FileExtensionEnum;

readonly class SettingsCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ImageUploadInterface $imageUpload
    )
    {
    }

    public function __invoke(SettingsCommand $command)
    {
        $settingsView = $command->getSettingsView();
        $mapImage = $command->getMapImage();

        if ($mapImage) {
            $mapImageVO = $this->imageUpload->upload($mapImage, FileExtensionEnum::WEBP);
        }
    }
}
