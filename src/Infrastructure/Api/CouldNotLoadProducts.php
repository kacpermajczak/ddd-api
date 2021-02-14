<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use RuntimeException;
use Safe\Exceptions\JsonException;

final class CouldNotLoadProducts extends RuntimeException
{
    public static function becauseJsonStructureIsInvalid(string $jsonData, JsonException $previous): self
    {
        return new self(
            sprintf(
                'Could not create Products DTOs because the provided JSON data is invalid: %s',
                $jsonData
            ), 0, $previous
        );
    }

    public static function becauseJsonDataIsInvalid(string $exceptionMessage): self
    {
        return new self(
            sprintf(
                'Could not create Products DTOs because the provided argument in JSON is invalid: %s',
                $exceptionMessage
            )
        );
    }
}
