<?php

declare(strict_types=1);

namespace App\Application\File\Markdown;

use App\Application\File\RemodelCollectionPolicy;
use App\Application\ProductsWithCategoriesResult;
use App\Domain\Price;

final class RemodelCollectionForMarkdownPolicy implements RemodelCollectionPolicy
{
    public function remodelCollection(ProductsWithCategoriesResult $productsWithCategoriesResult): void
    {
        $products = $productsWithCategoriesResult->products();
        foreach ($products->asArray() as $product) {
            if ($product->price()->greaterThan(Price::fromString('100 EUR'))) {
                continue;
            }
            $products->removeProductById($product->id());
        }
    }
}
