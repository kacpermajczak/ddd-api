<?php

declare(strict_types=1);

namespace App\Application;

interface CategoriesProvider
{
    public function provide(ProvideCategories $command): CategoryMapsCollection;
}
