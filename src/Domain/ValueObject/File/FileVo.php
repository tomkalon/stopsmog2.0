<?php

namespace App\Domain\ValueObject\File;

readonly class FileVo
{
    public function __construct(
        private string $name,
        private string $extension
    ) {
    }

    public function equals(FileVo $fileVo): bool
    {
        return $this->name === $fileVo->name && $this->extension === $fileVo->extension;
    }

    public function getFile(): string
    {
        return $this->name. '.' .$this->extension;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }
}
