<?php

declare(strict_types=1);

namespace App\Application\File\Csv;

use App\Application\CategoryMapsCollection;
use App\Application\File\FileHandler;
use App\Application\File\FileNameGenerator;
use App\Application\File\SavingFileService;
use App\Application\ProductsCollection;
use App\Application\ProductsWithCategoriesResult;

final class ProductSavingCsvService implements SavingFileService
{
    const EXTENSION = '.csv';
    private ProductCsvGenerator $productCsvGenerator;
    private FileHandler $fileHandler;
    private FileNameGenerator $fileNameGenerator;

    public function __construct(
        ProductCsvGenerator $productCsvGenerator,
        FileHandler $fileHandler,
        FileNameGenerator $fileNameGenerator
    ) {
        $this->productCsvGenerator = $productCsvGenerator;
        $this->fileHandler = $fileHandler;
        $this->fileNameGenerator = $fileNameGenerator;
    }

    public function save(ProductsWithCategoriesResult $productsWithCategoriesResult): void
    {
        $this->mapCategories(
            $productsWithCategoriesResult->categories(),
            $productsWithCategoriesResult->products()
        );
        $csv = $this->getCsv($productsWithCategoriesResult);
        $this->saveCsv($csv);
    }

    private function mapCategories(
        CategoryMapsCollection $categoryMapsCollection,
        ProductsCollection $productsCollection
    ): void {
        foreach ($productsCollection->asArray() as $product) {
            $newCategory = $categoryMapsCollection->findByOld($product->category());
            if ($newCategory === null) {
                continue;
            }
            $product->changeCategory($newCategory);
        }
    }

    /**
     * @param ProductsWithCategoriesResult $productsWithCategoriesResult
     * @return string
     */
    private function getCsv(ProductsWithCategoriesResult $productsWithCategoriesResult): string
    {
        $csv = $this->productCsvGenerator->generate($productsWithCategoriesResult);

        return $csv;
    }

    /**
     * @param string $csv
     */
    private function saveCsv(string $csv): void
    {
        $this->fileHandler->save($csv, $this->fileNameGenerator->generate().self::EXTENSION);
    }
}

