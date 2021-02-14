<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Category;

final class CategoryMapsCollection
{
    /**
     * @var CategoryMap[]
     */
    private array $categoryMaps;

    private function __construct()
    {
        $this->categoryMaps = [];
    }

    public static function empty(): self
    {
        return new self();
    }

    public function add(CategoryMap $categoryMap): void
    {
        $this->categoryMaps[] = $categoryMap;
    }

    public function asArray(): array
    {
        return $this->categoryMaps;
    }

    public function findByOld(Category $old): ?Category
    {
        foreach ($this->categoryMaps as $categoryMap) {
            if (!$categoryMap->old()->equals($old)) {
                continue;
            }

            return $categoryMap->new();
        }

        return null;
    }
}
