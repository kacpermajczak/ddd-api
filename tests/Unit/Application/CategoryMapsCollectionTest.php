<?php
declare(strict_types=1);

namespace App\Tests\Unit\Application;

use App\Application\CategoryMap;
use App\Application\CategoryMapsCollection;
use App\Domain\Category;
use PHPUnit\Framework\TestCase;

class CategoryMapsCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_return_new_category_using_old_one(): void
    {
        //given
        $old = Category::fromString('test1');
        $new = Category::fromString('test2');

        $categoryMap = CategoryMap::fromPair($old, $new);
        $categoryCollection = CategoryMapsCollection::empty();
        $categoryCollection->add($categoryMap);

        //when
        $result = $categoryCollection->findByOld($old);

        //then
        $this->assertEquals($new, $result);
    }

    /**
     * @test
     */
    public function it_can_return_null_if_not_found(): void
    {
        //given
        $old = Category::fromString('test1');
        $new = Category::fromString('test2');
        $test = Category::fromString('test3');

        $categoryMap = CategoryMap::fromPair($old, $new);
        $categoryCollection = CategoryMapsCollection::empty();
        $categoryCollection->add($categoryMap);

        //when
        $result = $categoryCollection->findByOld($test);

        //then
        $this->assertEquals(null, $result);
    }
}
