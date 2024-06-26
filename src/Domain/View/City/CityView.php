<?php

namespace App\Domain\View\City;

use App\Domain\Entity\City;
use App\Domain\Entity\File;
use App\Domain\ValueObject\File\FileVo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CityView
{
    private ?int $id;
    private ?string $name;
    private ?int $positionX;
    private ?int $positionY;
    private array $sensors;
    private ?File $map;
    private ?FileVo $fileVo = null;
    private ?UploadedFile $uploadedFile = null;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?int $positionX = null,
        ?int $positionY = null,
        array $sensors = [],
        ?File $map = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->sensors = $sensors;
        $this->map = $map;
    }

    public static function fromEntity(City $city): self
    {
        return new self(
            $city->getId(),
            $city->getName(),
            $city->getPositionX(),
            $city->getPositionY(),
            $city->getSensors()->toArray(),
            $city->getMap()
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getPositionX(): ?int
    {
        return $this->positionX;
    }

    public function setPositionX(?int $positionX): void
    {
        $this->positionX = $positionX;
    }

    public function getPositionY(): ?int
    {
        return $this->positionY;
    }

    public function setPositionY(?int $positionY): void
    {
        $this->positionY = $positionY;
    }

    public function getSensors(): array
    {
        return $this->sensors;
    }

    public function setSensors(array $sensors): void
    {
        $this->sensors = $sensors;
    }

    public function getMap(): ?File
    {
        return $this->map;
    }

    public function setMap(?File $map): void
    {
        $this->map = $map;
    }

    public function getFileVo(): ?FileVo
    {
        return $this->fileVo;
    }

    public function setFileVo(?FileVo $fileVo): void
    {
        $this->fileVo = $fileVo;
    }

    public function getUploadedFile(): ?UploadedFile
    {
        return $this->uploadedFile;
    }

    public function setUploadedFile(?UploadedFile $uploadedFile): void
    {
        $this->uploadedFile = $uploadedFile;
    }
}
