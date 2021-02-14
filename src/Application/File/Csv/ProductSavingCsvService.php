<?php

declare(strict_types=1);

namespace App\Application\File\Csv;

use App\Application\File\FileHandler;
use App\Application\File\FileNameGenerator;
use App\Application\File\RemodelCollectionPolicy;
use App\Application\File\SavingFileService;
use App\Application\ProductsWithCategoriesResult;

final class ProductSavingCsvService implements SavingFileService
{
    const EXTENSION = '.csv';
    private ProductCsvGenerator $productCsvGenerator;
    private FileHandler $fileHandler;
    private FileNameGenerator $fileNameGenerator;
    private RemodelCollectionPolicy $policy;

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
        $this->policy->remodelCollection($productsWithCategoriesResult);
        $this->fileHandler->save(
            $this->productCsvGenerator->generate($productsWithCategoriesResult),
            $this->fileNameGenerator->generate(self::EXTENSION)
        );
    }

    public function setPolicy(RemodelCollectionPolicy $policy): void
    {
        $this->policy = $policy;
    }
}

