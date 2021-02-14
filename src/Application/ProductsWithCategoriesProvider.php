<?php
declare(strict_types=1);

namespace App\Application;

interface ProductsWithCategoriesProvider
{
    public function findAll(GetProductsWithCategories $getProductsWithCategories): ProductsWithCategoriesResult;
}
