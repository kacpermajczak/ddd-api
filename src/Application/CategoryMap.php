<?php
declare(strict_types=1);

namespace App\Application;

use App\Domain\Category;

final class CategoryMap
{
    private Category $old;
    private Category $new;

    private function __construct(Category $old, Category $new)
    {
        $this->old = $old;
        $this->new = $new;
    }

    public static function fromPair(Category $old, Category $new): self
    {
        return new self($old, $new);
    }

    public function old(): Category
    {
        return $this->old;
    }

    public function new(): Category
    {
        return $this->new;
    }
}
