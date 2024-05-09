<?php

namespace App\Application\Service\File;

use App\Domain\Enum\FileExtensionEnum;
use App\Domain\ValueObject\File\FileVo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ImageUploadInterface
{
    public function upload(UploadedFile $file, ?FileExtensionEnum $extension = null): ?FileVo;

    public function getTargetDirectory(): string;
}
