<?php
declare(strict_types=1);

namespace App\Tests\Unit\Application;

use App\Application\ProvideProducts;
use PHPUnit\Framework\TestCase;

class ProvideProductsTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_created_from_valid_url(): void
    {
        //given
        $validUrl = 'http://www.some-valid-url.com/';

        //when
        $command = ProvideProducts::fromUrl($validUrl);

        //then
        $this->assertEquals($validUrl, $command->getProductsUrl());
    }

    /**
     * @test
     */
    public function it_cannot_be_created_from_invalid_url(): void
    {
        //then
        $this->expectException(\InvalidArgumentException::class);

        //given
        $invalidUrl = 'some.invalid.url';

        //when
        ProvideProducts::fromUrl($invalidUrl);
    }
}
