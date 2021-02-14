<?php
declare(strict_types=1);

namespace App\Application\File\Csv;

use App\Application\ProductsWithCategoriesResult;

interface ProductCsvGenerator
{
    public function generate(ProductsWithCategoriesResult $productsWithCategoriesResult): string;
}
