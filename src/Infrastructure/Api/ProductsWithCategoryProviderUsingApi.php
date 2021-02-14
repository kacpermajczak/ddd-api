<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Application\CategoriesProvider;
use App\Application\GetProductsWithCategories;
use App\Application\ProductsProvider;
use App\Application\ProductsWithCategoriesProvider;
use App\Application\ProductsWithCategoriesResult;
use App\Application\ProvideCategories;
use App\Application\ProvideProducts;

final class ProductsWithCategoryProviderUsingApi implements ProductsWithCategoriesProvider
{
    private ProductsProvider $productsProvider;
    private CategoriesProvider $categoriesProvider;

    public function __construct(ProductsProvider $productsProvider, CategoriesProvider $categoriesProvider)
    {
        $this->productsProvider = $productsProvider;
        $this->categoriesProvider = $categoriesProvider;
    }

    /**
     * Why two connections one by one?
     * @see adr-001
     */
    public function findAll(GetProductsWithCategories $getProductsWithCategories): ProductsWithCategoriesResult
    {
        $products = $this->productsProvider->provide(
            ProvideProducts::fromUrl($getProductsWithCategories->getProductsUrl())
        );
        $categories = $this->categoriesProvider->provide(
            ProvideCategories::fromUrl($getProductsWithCategories->getCategoriesUrl())
        );

        return ProductsWithCategoriesResult::fromCollections($products, $categories);
    }
}
