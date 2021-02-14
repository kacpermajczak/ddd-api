<?php

declare(strict_types=1);

namespace App\Infrastructure\Common\Csv;

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;

final class CsvGeneratorUsingSymfonyBundle implements CsvGenerator
{
    public function generate(array $data): string
    {
        $serializer = new Serializer([], [new CsvEncoder()]);

        return $serializer->encode($data, 'csv');
    }
}
