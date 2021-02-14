<?php

declare(strict_types=1);

namespace App\Application\File\Markdown;

use App\Application\File\SavingFileService;
use App\Application\ProductsCollection;
use App\Application\ProductsWithCategoriesResult;
use App\Domain\Price;

final class SavingMarkdownService implements SavingFileService
{
    public function save(ProductsWithCategoriesResult $productsWithCategoriesResult): void
    {
        $this->filterProducts($productsWithCategoriesResult->products());

        //todo - implement rendering markdown
    }

    private function filterProducts(ProductsCollection $products): void
    {
        foreach ($products->asArray() as $product) {
            if ($product->price()->greaterThan(Price::fromString('100 EUR'))) {
                continue;
            }
            $products->removeProductById($product->id());
        }
    }
}
