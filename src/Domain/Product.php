<?php
declare(strict_types=1);

namespace App\Domain;

final class Product
{
    private ProductId $id;
    private Title $title;
    private Category $category;
    private Price $price;

    public function __construct(ProductId $id, Title $title, Category $category, Price $price)
    {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->price = $price;
    }

    public static function fromScalars(
        int $id,
        string $title,
        string $category,
        string $price
    ): Product {
        return new Product(
            ProductId::fromInt($id),
            Title::fromString($title),
            Category::fromString($category),
            Price::fromString($price)
        );
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function category(): Category
    {
        return $this->category;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function changeCategory(Category $category): void
    {
        $this->category = $category;
    }
}
