<?php
declare(strict_types=1);

namespace App\Application\File;

use App\Application\ProductsWithCategoriesResult;

interface SavingFileService
{
    public function save(ProductsWithCategoriesResult $productsWithCategoriesResult): void;
    public function setPolicy(RemodelCollectionPolicy $policy): void;
}
