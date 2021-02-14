<?php
declare(strict_types=1);

namespace App\Application\File;

use App\Application\ProductsWithCategoriesResult;

interface RemodelCollectionPolicy
{
    public function remodelCollection(ProductsWithCategoriesResult $productsWithCategoriesResult): void;
}
