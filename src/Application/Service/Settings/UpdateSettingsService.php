<?php

namespace App\Application\Service\Settings;

use App\Domain\Entity\File;
use App\Domain\Entity\Settings;
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
        /** @var Settings $settings */
        $settings = $this->settingsRepository->find('settings');

        if ($fileVo) {
            $image = new File();
            $image->setName($fileVo->getName());
            $image->setExtension(FileExtensionEnum::tryFrom($fileVo->getExtension()));
            $this->em->persist($image);
            $settings->setMapImage($image);
        }
        $this->em->persist($settings);
        $this->em->flush();
    }
}
