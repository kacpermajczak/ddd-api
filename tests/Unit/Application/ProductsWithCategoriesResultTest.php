<?php
declare(strict_types=1);

namespace App\Tests\Unit\Application;

use App\Application\CategoryMapsCollection;
use App\Application\ProductsCollection;
use App\Application\ProductsWithCategoriesResult;
use PHPUnit\Framework\TestCase;

class ProductsWithCategoriesResultTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_created_from_collections(): void
    {
        //given
        $productsCollection = ProductsCollection::empty();
        $categoriesCollection = CategoryMapsCollection::empty();

        //when
        $result = ProductsWithCategoriesResult::fromCollections($productsCollection, $categoriesCollection);

        //then
        $this->assertInstanceOf(ProductsCollection::class, $result->products());
        $this->assertInstanceOf(CategoryMapsCollection::class, $result->categories());
    }

}
