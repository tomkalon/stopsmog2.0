<?php

namespace App\Application\Service\File;

use App\Domain\Enum\FileExtensionEnum;
use App\Domain\ValueObject\File\FileVo;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\EncodedImageInterface;
use Intervention\Image\Interfaces\ImageInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

readonly class ImageUploadService implements ImageUploadInterface
{
    public function __construct(
        private string           $targetDirectory,
        private string           $defaultImgExtension,
        private SluggerInterface $slugger,
    ) {
    }

    public function upload(UploadedFile $file, ?FileExtensionEnum $extension = null): ?FileVo
    {
        // set fileName
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $name = $safeFilename . '-' . uniqid();

        $fileName = $name . '.' .$file->guessExtension();

        if ($extension) {
            $ext = $extension->value;
        } else {
            $ext = $this->defaultImgExtension;
        }

        $imageDirectory = $this->getTargetDirectory() . '/';
        $imagePath = $imageDirectory . $fileName;

        try {
            $file->move($this->getTargetDirectory(), $fileName);

            $filesystem = new Filesystem();
            $readFile = file_get_contents($imagePath);
            if ($filesystem->exists($imagePath)) {
                $filesystem->remove($imagePath);
            }

            $manager = new ImageManager(new Driver());
            $originalImage = $manager->read($readFile);
            $image = $this->getImage($originalImage, $extension);

            $image->save($imageDirectory . $name . '.' . $ext);

            return new FileVo($name, $ext);
        } catch (FileException) {
            return null;
        }
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }

    private function getImage(ImageInterface $image, ?FileExtensionEnum $extension = null): EncodedImageInterface {
        return match ($extension) {
            FileExtensionEnum::PNG => $image->toPng(),
            FileExtensionEnum::WEBP => $image->toWebp(),
            default => $image->toJpeg(),
        };
    }
}
