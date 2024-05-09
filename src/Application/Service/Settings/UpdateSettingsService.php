<?php

namespace App\Application\Service\Settings;

use App\Domain\Entity\FileSettings;
use App\Domain\Enum\FileExtensionEnum;
use App\Domain\Repository\SettingsRepositoryInterface;
use App\Domain\ValueObject\File\FileVo;
use App\Domain\View\Settings\SettingsView;
use Doctrine\ORM\EntityManagerInterface;

readonly class UpdateSettingsService implements UpdateSettingsInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private SettingsRepositoryInterface $settingsRepository
    ) {
    }
    public function persist(SettingsView $settingsView, ?FileVo $fileVo = null)
    {
        $settings = $this->settingsRepository->find('settings');

        if ($fileVo) {
            $image = new FileSettings();
            $image->setSettings($settings);
            $image->setName($fileVo->getName());
            $image->setExtension(FileExtensionEnum::tryFrom($fileVo->getExtension()));
            $this->em->persist($image);
            $settings->setMapImage($image);
        }
        $this->em->persist($settings);
    }
}
