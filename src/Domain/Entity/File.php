<?php

namespace App\Domain\Entity;

use App\Domain\Enum\FileExtensionEnum;
use App\Domain\Trait\IdTrait;
use App\Domain\Trait\LifecycleTrait;

class File
{
    use IdTrait;
    use LifecycleTrait;

    protected string $name;
    private FileExtensionEnum $extension;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getExtension(): FileExtensionEnum
    {
        return $this->extension;
    }

    public function setExtension(FileExtensionEnum $extension): void
    {
        $this->extension = $extension;
    }

    public function getFilename(): string
    {
        return $this->name . '.' . $this->extension->value;
    }
}
