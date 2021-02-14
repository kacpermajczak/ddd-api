<?php
declare(strict_types=1);

namespace App\Tests\Unit\Application;

use App\Application\ProductsCollection;
use App\Domain\Product;
use PHPUnit\Framework\TestCase;

class ProductsCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_add_new_product(): void
    {
        //given
        $productsCollection = ProductsCollection::empty();
        $product = Product::fromScalars(1, 'title', 'category', '97 EUR');

        //when
        $productsCollection->addProduct($product);

        //then
        $this->assertCount(1, $productsCollection->asArray());
    }

    /**
     * @test
     */
    public function it_can_remove_product(): void
    {
        //given
        $productsCollection = ProductsCollection::empty();
        $product = Product::fromScalars(1, 'title', 'category', '97 EUR');
        $productsCollection->addProduct($product);
        $this->assertCount(1, $productsCollection->asArray());

        //when
        $productsCollection->removeProductById($product->id());

        //then
        $this->assertCount(0, $productsCollection->asArray());
    }

    /**
     * @test
     */
    public function it_can_return_array_in_expected_domain_format(): void
    {
        //given
        $productsCollection = ProductsCollection::empty();
        $product = Product::fromScalars(1, 'title', 'category', '97 EUR');
        $productsCollection->addProduct($product);

        //when
        $array = $productsCollection->asViewArray();
        $firstElement = $array[0];

        //then
        $this->assertIsArray($array);
        $this->assertArrayHasKey('ID', $firstElement);
        $this->assertArrayHasKey('Title', $firstElement);
        $this->assertArrayHasKey('Category', $firstElement);
        $this->assertArrayHasKey('Price', $firstElement);
    }
}
