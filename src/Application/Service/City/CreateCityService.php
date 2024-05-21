<?php

namespace App\Application\Service\City;

use App\Domain\Entity\City;
use App\Domain\Entity\File;
use App\Domain\Enum\FileExtensionEnum;
use App\Domain\View\City\CityView;
use Doctrine\ORM\EntityManagerInterface;

readonly class CreateCityService implements CityServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function save(CityView $cityView): void
    {
        $city = new City();
        $city->setName($cityView->getName());
        $city->setPositionX($cityView->getPositionX());
        $city->setPositionY($cityView->getPositionY());

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
