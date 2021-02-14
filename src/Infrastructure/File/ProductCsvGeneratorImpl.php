<?php

declare(strict_types=1);

namespace App\Infrastructure\File;

use App\Application\File\Csv\ProductCsvGenerator;
use App\Application\ProductsWithCategoriesResult;
use App\Infrastructure\Common\Csv\CsvGenerator;

final class ProductCsvGeneratorImpl implements ProductCsvGenerator
{
    private CsvGenerator $csvGenerator;

    public function __construct(CsvGenerator $csvGenerator)
    {
        $this->csvGenerator = $csvGenerator;
    }

    public function generate(ProductsWithCategoriesResult $productsWithCategoriesResult): string
    {
        return $this->generateCsv($productsWithCategoriesResult);
    }

    private function generateCsv(ProductsWithCategoriesResult $categoriesResult): string
    {
        return $this->csvGenerator->generate($categoriesResult->products()->asViewArray());
    }
}
