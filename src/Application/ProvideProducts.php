<?php
declare(strict_types=1);

namespace App\Application;

use Assert\Assert;

final class ProvideProducts
{
    private string $productsUrl;

    private function __construct(string $productsUrl)
    {
        $this->productsUrl = $productsUrl;
    }

    public static function fromUrl(string $productsUrl): ProvideProducts
    {
        Assert::that($productsUrl)->url();

        return new self($productsUrl);
    }

    public function getProductsUrl(): string
    {
        return $this->productsUrl;
    }
}
