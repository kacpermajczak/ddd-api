<?php
declare(strict_types=1);

namespace App\Infrastructure\FlySystem;

use App\Application\File\FileHandler;
use League\Flysystem\FilesystemOperator;

final class FileHandlerUsingFlySystem implements FileHandler
{
    private FilesystemOperator $filesystemOperator;

    public function __construct(FilesystemOperator $defaultStorage)
    {
        $this->filesystemOperator = $defaultStorage;
    }

    public function save(string $content, string $filePath): void
    {
        $this->filesystemOperator->write($filePath, $content);
    }
}
