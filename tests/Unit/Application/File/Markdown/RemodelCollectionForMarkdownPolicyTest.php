<?php
declare(strict_types=1);

namespace App\Tests\Unit\Application\File\Markdown;

use App\Application\CategoryMap;
use App\Application\CategoryMapsCollection;
use App\Application\File\Markdown\RemodelCollectionForMarkdownPolicy;
use App\Application\ProductsCollection;
use App\Application\ProductsWithCategoriesResult;
use App\Domain\Category;
use App\Domain\Product;
use PHPUnit\Framework\TestCase;

class RemodelCollectionForMarkdownPolicyTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_filter_products_which_are_cheaper_than_100_eur(): void
    {
        //given
        $categoryCollection = $this->categoryCollection();
        $productsCollection = $this->productsCollection();
        $productsWithCategoriesResult = ProductsWithCategoriesResult::fromCollections(
            $productsCollection,
            $categoryCollection
        );
        $policy = new RemodelCollectionForMarkdownPolicy();

        //then
        $this->assertCount(2, $productsCollection->asArray());

        //when
        $policy->remodelCollection($productsWithCategoriesResult);

        //then
        $this->assertCount(1, $productsCollection->asArray());
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
        $productsCollection->addProduct(Product::fromScalars(2, 'some other title', 'some category', '10 EUR'));

        return $productsCollection;
    }
}
