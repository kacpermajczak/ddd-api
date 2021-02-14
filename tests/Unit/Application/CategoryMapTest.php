<?php
declare(strict_types=1);

namespace App\Tests\Unit\Application;

use App\Application\CategoryMap;
use App\Domain\Category;
use PHPUnit\Framework\TestCase;

class CategoryMapTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_created_from_categories(): void
    {
        //given
        $old = Category::fromString('test1');
        $new = Category::fromString('test2');

        //when
        $categoryMap = CategoryMap::fromPair($old, $new);

        //then
        $this->assertEquals($old, $categoryMap->old());
        $this->assertEquals($new, $categoryMap->new());
    }
}
