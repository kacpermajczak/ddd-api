<?php
declare(strict_types=1);

namespace App\Application;

use Assert\Assert;

final class ProvideCategories
{
    private string $categoriesUrl;

    private function __construct(string $categoriesUrl)
    {
        $this->categoriesUrl = $categoriesUrl;
    }

    public static function fromUrl(string $categoriesUrl): ProvideCategories
    {
        Assert::that($categoriesUrl)->url();

        return new self($categoriesUrl);
    }

    public function getCategoriesUrl(): string
    {
        return $this->categoriesUrl;
    }
}
