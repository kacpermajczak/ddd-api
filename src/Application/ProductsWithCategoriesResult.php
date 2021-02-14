<?php

declare(strict_types=1);

namespace App\Application;

final class ProductsWithCategoriesResult
{
    private ProductsCollection $products;
    private CategoryMapsCollection $categories;

    public function __construct(
        ProductsCollection $products,
        CategoryMapsCollection $categories
    ) {
        $this->products = $products;
        $this->categories = $categories;
    }

    public static function fromCollections(
        ProductsCollection $products,
        CategoryMapsCollection $categories
    ): self {
        return new self($products, $categories);
    }

    public function products(): ProductsCollection
    {
        return $this->products;
    }

    public function categories(): CategoryMapsCollection
    {
        return $this->categories;
    }
}
