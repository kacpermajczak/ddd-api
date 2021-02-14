<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Product;
use App\Domain\ProductId;

final class ProductsCollection
{
    /**
     * @var Product[]
     */
    private array $productsArray;

    private function __construct()
    {
        $this->productsArray = [];
    }

    public static function empty(): self
    {
        return new self();
    }

    public function addProduct(Product $product): void
    {
        $this->productsArray[$product->id()->asNumber()] = $product;
    }

    public function removeProductById(ProductId $productId): void
    {
        unset($this->productsArray[$productId->asNumber()]);
    }

    /**
     * @return array<string,mixed>
     */
    public function asViewArray(): array
    {
        $viewArray = [];
        foreach ($this->productsArray as $product) {
            $viewArray[] = [
                'ID' => $product->id()->asNumber(),
                'Title' => $product->title()->asString(),
                'Category' => $product->category()->asString(),
                'Price' => $product->price()->asString(),
            ];
        }

        return $viewArray;
    }

    public function asArray(): array
    {
        return $this->productsArray;
    }
}
