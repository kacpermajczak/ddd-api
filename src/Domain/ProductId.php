<?php

declare(strict_types=1);

namespace App\Domain;

final class ProductId
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public static function fromInt(int $id): ProductId
    {
        return new self($id);
    }

    public function asNumber(): int
    {
        return $this->id;
    }
}
