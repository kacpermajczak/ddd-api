<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\Csv;

interface CsvGenerator
{
    public function generate(array $data): string;
}
