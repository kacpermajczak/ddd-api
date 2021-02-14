<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use App\Domain\Category;
use App\Domain\Price;
use App\Domain\Product;
use App\Domain\ProductId;
use App\Domain\Title;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_created_from_scalars(): void
    {
        //given
        $id = 1;
        $title = 'title';
        $category = 'category';
        $price = '97 EUR';

        //when
        $product = Product::fromScalars($id, $title, $category, $price);

        //then
        $this->assertEquals($product->id(), ProductId::fromInt($id));
        $this->assertEquals($product->title(), Title::fromString($title));
        $this->assertEquals($product->category(), Category::fromString($category));
        $this->assertEquals($product->price(), Price::fromString($price));
    }

    /**
     * @test
     */
    public function it_can_change_category(): void
    {
        //given
        $product = Product::fromScalars(1, 'title', 'category', '97 EUR');
        $newCategory = Category::fromString('new category');

        //when
        $product->changeCategory($newCategory);

        //then
        $this->assertEquals($newCategory, $product->category());
    }
}
