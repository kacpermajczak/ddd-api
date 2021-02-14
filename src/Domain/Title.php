<?php

declare(strict_types=1);

namespace App\Domain;

use Assert\Assert;

final class Title
{
    private string $title;

    private function __construct(string $title)
    {
        Assert::that($title)->maxLength(100);
        $this->title = $title;
    }

    public static function fromString(string $title): Title
    {
        return new self($title);
    }

    public function asString(): string
    {
        return $this->title;
    }
}
