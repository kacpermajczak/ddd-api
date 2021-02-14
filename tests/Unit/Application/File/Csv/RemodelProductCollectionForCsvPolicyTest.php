<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\File\Csv;

use App\Application\CategoryMap;
use App\Application\CategoryMapsCollection;
use App\Application\File\Csv\RemodelCollectionForCsvPolicy;
use App\Application\ProductsCollection;
use App\Application\ProductsWithCategoriesResult;
use App\Domain\Category;
use App\Domain\Product;
use App\Domain\ProductId;
use PHPUnit\Framework\TestCase;

class RemodelProductCollectionForCsvPolicyTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_replace_categories_in_products_collection(): void
    {
        //given
        $categoryCollection = $this->categoryCollection();
        $productsCollection = $this->productsCollection();
        $productsWithCategoriesResult = ProductsWithCategoriesResult::fromCollections(
            $productsCollection,
            $categoryCollection
        );
        $policy = new RemodelCollectionForCsvPolicy();

        //then
        $this->assertCount(2, $productsCollection->asArray());

        //when
        $policy->remodelCollection($productsWithCategoriesResult);

        //then
        $this->assertEquals(
            'test2',
            $productsCollection->findById(ProductId::fromInt(1))->category()->asString()
        );
        $this->assertEquals(
            'some category',
            $productsCollection->findById(ProductId::fromInt(2))->category()->asString()
        );
    }

    private function categoryCollection(): CategoryMapsCollection
    {
        $old = Category::fromString('test1');
        $new = Category::fromString('test2');
        $categoryMap = CategoryMap::fromPair($old, $new);
        $categoryCollection = CategoryMapsCollection::empty();
        $categoryCollection->add($categoryMap);

        return $categoryCollection;
    }

    private function productsCollection(): ProductsCollection
    {
        $productsCollection = ProductsCollection::empty();
        $productsCollection->addProduct(Product::fromScalars(1, 'some title', 'test1', '284 EUR'));
        $productsCollection->addProduct(Product::fromScalars(2, 'some other title', 'some category', '129 EUR'));

        return $productsCollection;
    }
}
