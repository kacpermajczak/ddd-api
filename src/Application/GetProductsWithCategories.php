<?php

declare(strict_types=1);

namespace App\Application;

use Assert\Assert;

final class GetProductsWithCategories
{
    private string $productsUrl;
    private string $categoriesUrl;

    private function __construct(string $productsUrl, string $categoriesUrl)
    {
        $this->productsUrl = $productsUrl;
        $this->categoriesUrl = $categoriesUrl;
    }

    public static function fromUrl(string $productsUrl, string $categoriesUrl): GetProductsWithCategories
    {
        Assert::that($productsUrl)->url();
        Assert::that($categoriesUrl)->url();

        return new self($productsUrl, $categoriesUrl);
    }

    public function getProductsUrl(): string
    {
        return $this->productsUrl;
    }

    public function getCategoriesUrl(): string
    {
        return $this->categoriesUrl;
    }
}
