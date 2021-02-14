<?php

declare(strict_types=1);

namespace App\Infrastructure\Common;

use Safe\Exceptions\JsonException;

use function Safe\json_decode;

final class JsonHandler
{
    /**
     * @throws JsonException
     */
    public function jsonDecode(string $json, bool $assoc = false, int $depth = 512, int $options = 0)
    {
        return json_decode($json, $assoc, $depth, $options);
    }
}
