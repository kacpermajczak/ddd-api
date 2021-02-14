<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\File\SavingFilesServicesCollection;

final class ApplicationFacade
{
    private ProductsWithCategoriesProvider $productsWithCategoriesProvider;
    private SavingFilesServicesCollection $savingFilesServicesCollection;

    public function __construct(
        ProductsWithCategoriesProvider $productsWithCategoriesProvider,
        SavingFilesServicesCollection $savingFilesServicesCollection
    ) {
        $this->productsWithCategoriesProvider = $productsWithCategoriesProvider;
        $this->savingFilesServicesCollection = $savingFilesServicesCollection;
    }

    public function saveFilesWithProducts(GetProductsWithCategories $getProductsWithCategories): void
    {
        $productsWithCategories = $this->productsWithCategoriesProvider->findAll($getProductsWithCategories);

        foreach ($this->savingFilesServicesCollection->getServices() as $savingFileService) {
            $savingFileService->save($productsWithCategories);
        }
    }
}
