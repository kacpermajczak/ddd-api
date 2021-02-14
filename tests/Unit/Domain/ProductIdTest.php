<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use App\Domain\ProductId;
use PHPUnit\Framework\TestCase;

class ProductIdTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_created_from_int(): void
    {
        //given
        $id = 1;

        //when
        $productId = ProductId::fromInt($id);

        //then
        $this->assertEquals($id, $productId->asNumber());
    }
}
