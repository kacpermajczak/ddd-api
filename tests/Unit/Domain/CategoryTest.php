<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use App\Domain\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_created_from_string(): void
    {
        //given
        $categoryName = 'category';

        //when
        $category = Category::fromString($categoryName);

        //then
        $this->assertEquals($categoryName, $category->asString());
    }

    /**
     * @test
     */
    public function name_cannot_be_longer_than_35_characters(): void
    {
        //then
        $this->expectException(\InvalidArgumentException::class);

        //given
        $categoryName = 'some sentence longer than 35 characters';

        //when
        Category::fromString($categoryName);
    }

    /**
     * @test
     */
    public function it_can_be_compared_with_another_category(): void
    {
        //given
        $someCategory = 'category';
        $anotherCategory = 'category';

        //when
        $someCategoryObj = Category::fromString($someCategory);
        $anotherCategoryObj = Category::fromString($anotherCategory);

        //then
        $this->assertTrue($someCategoryObj->equals($anotherCategoryObj));
    }
}
