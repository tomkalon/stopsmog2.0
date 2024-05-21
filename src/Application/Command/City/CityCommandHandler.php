<?php

namespace App\Application\Command\City;

use App\Application\Service\City\CityServiceInterface;
use App\Application\Service\CQRS\Command\CommandHandlerInterface;
use App\Application\Service\File\ImageUploadInterface;
use App\Domain\Enum\FileExtensionEnum;
use Exception;

readonly class CityCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private CityServiceInterface $createCityService,
        private CityServiceInterface $updateCityService,
        private ImageUploadInterface $imageUpload,
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke(CityCommand $command): void
    {
        $cityView = $command->getCityView();
        $uploadedFile = $cityView->getUploadedFile();

        if ($uploadedFile) {
            $cityView->setFileVo($this->imageUpload->upload($uploadedFile, FileExtensionEnum::WEBP));
        }

        if ($cityView->getId()) {
            $this->updateCityService->save($cityView);
        } else {
            $this->createCityService->save($cityView);
        }
    }
}
