<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use App\Domain\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    /**
     * @test
     */
    public function price_should_be_separated_with_one_space(): void
    {
        //then
        $this->expectException(\InvalidArgumentException::class);

        //given
        $invalidPrice = '100 USD EUR';

        //when
        Price::fromString($invalidPrice);
    }

    /**
     * @test
     */
    public function price_should_be_positive_number(): void
    {
        //then
        $this->expectException(\InvalidArgumentException::class);

        //given
        $invalidPrice = '-100 EUR';

        //when
        Price::fromString($invalidPrice);
    }

    /**
     * @test
     */
    public function it_can_be_created_from_correct_string(): void
    {
        //given
        $priceString = '95 EUR';

        //when
        $price = Price::fromString($priceString);

        //then
        $this->assertEquals($priceString, $price->asString());
    }

    /**
     * @test
     */
    public function it_can_decide_if_greater_than_other_price(): void
    {
        //given
        $lowerPrice = Price::fromString('100 EUR');
        $higherPrice = Price::fromString('200 EUR');

        //then
        $this->assertTrue($higherPrice->greaterThan($lowerPrice));
    }

    public function it_cannot_be_compared_with_different_currencies()
    {
        //then
        $this->expectException(\InvalidArgumentException::class);

        //given
        $somePrice = Price::fromString('1 PLN');
        $someOtherPrice = Price::fromString('1 USD');

        //when
        $someOtherPrice->greaterThan($somePrice);
    }
}
