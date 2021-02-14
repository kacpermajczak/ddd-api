<?php

declare(strict_types=1);

namespace App\Domain;

use Assert\Assert;

final class Category
{
    private string $category;

    private function __construct(string $category)
    {
        Assert::that($category)->maxLength(35);
        $this->category = $category;
    }

    public static function fromString(string $category): Category
    {
        return new self($category);
    }

    public function asString(): string
    {
        return $this->category;
    }

    public function equals(Category $category): bool
    {
        return $this->category === $category->asString();
    }
}
