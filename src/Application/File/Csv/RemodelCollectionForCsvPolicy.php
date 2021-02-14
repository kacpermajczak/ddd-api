<?php
declare(strict_types=1);

namespace App\Application\File\Csv;

use App\Application\File\RemodelCollectionPolicy;
use App\Application\ProductsWithCategoriesResult;

final class RemodelCollectionForCsvPolicy implements RemodelCollectionPolicy
{
    public function remodelCollection(ProductsWithCategoriesResult $productsWithCategoriesResult): void
    {
        $productsCollection = $productsWithCategoriesResult->products();
        $categoryMapsCollection = $productsWithCategoriesResult->categories();

        foreach ($productsCollection->asArray() as $product) {
            $newCategory = $categoryMapsCollection->findByOld($product->category());
            if ($newCategory === null) {
                continue;
            }
            $product->changeCategory($newCategory);
        }
    }
}
