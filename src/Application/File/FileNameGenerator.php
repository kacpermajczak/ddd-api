<?php
declare(strict_types=1);

namespace App\Application\File;

interface FileNameGenerator
{
    public function generate(): string;
}
