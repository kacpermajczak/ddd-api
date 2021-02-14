<?php

declare(strict_types=1);

namespace App\Infrastructure\File;

use App\Application\File\FileNameGenerator;
use Ramsey\Uuid\Uuid;

final class FileNameGeneratorUsingUuid implements FileNameGenerator
{
    public function generate(string $extension): string
    {
        return Uuid::uuid4()->toString().$extension;
    }
}
