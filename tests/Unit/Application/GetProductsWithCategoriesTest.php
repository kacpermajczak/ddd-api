<?php
declare(strict_types=1);

namespace App\Tests\Unit\Application;

use App\Application\GetProductsWithCategories;
use PHPUnit\Framework\TestCase;

class GetProductsWithCategoriesTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_created_from_valid_urls(): void
    {
        //given
        $productsUrl = 'http://www.some-url.com';
        $categoryUrl = 'http://www.another-url.com';

        //when
        $command = GetProductsWithCategories::fromUrl($productsUrl, $categoryUrl);

        //then
        $this->assertEquals($productsUrl, $command->getProductsUrl());
        $this->assertEquals($categoryUrl, $command->getCategoriesUrl());
    }

    public function it_cannot_be_created_from_invalid_products_url(): void
    {
        //then
        $this->expectException(\InvalidArgumentException::class);

        //given
        $productsUrl = 'some.invalid.url';
        $categoryUrl = 'http://www.another-url.com';

        //when
        GetProductsWithCategories::fromUrl($productsUrl, $categoryUrl);

    }

    /**
     * @test
     */
    public function it_cannot_be_created_from_invalid_categories_url(): void
    {
        //then
        $this->expectException(\InvalidArgumentException::class);

        //given
        $productsUrl = 'http://www.some-url.com';
        $categoryUrl = 'some.invalid.url';

        //when
        GetProductsWithCategories::fromUrl($productsUrl, $categoryUrl);
    }
}
