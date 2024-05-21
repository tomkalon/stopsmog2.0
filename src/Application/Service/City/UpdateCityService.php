<?php

namespace App\Application\Service\City;

use App\Domain\Entity\File;
use App\Domain\Enum\FileExtensionEnum;
use App\Domain\Repository\CityRepositoryInterface;
use App\Domain\View\City\CityView;
use Doctrine\ORM\EntityManagerInterface;

readonly class UpdateCityService implements CityServiceInterface
{
    public function __construct(
        private CityRepositoryInterface $sensorRepository,
        private EntityManagerInterface $em
    ) {
    }

    public function save(CityView $cityView): void
    {
        $city = $this->sensorRepository->findOneBy(['id' => $cityView->getId()]);
        $city->setName($cityView->getName() ?: $city->getName());
        $city->setPositionX($cityView->getPositionX() ?: $city->getPositionX());
        $city->setPositionY($cityView->getPositionY() ?: $city->getPositionY());

        if ($cityView->getFileVo()) {
            $image = new File();
            $image->setName($cityView->getFileVo()->getName());
            $image->setExtension(FileExtensionEnum::tryFrom($cityView->getFileVo()->getExtension()));
            $this->em->persist($image);
            $city->setMap($image);
        }
        $this->em->persist($city);
    }
}
