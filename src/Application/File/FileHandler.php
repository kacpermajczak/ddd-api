<?php
declare(strict_types=1);

namespace App\Application\File;

interface FileHandler
{
    public function save(string $content, string $filePath): void;
}
