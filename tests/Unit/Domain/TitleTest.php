<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain;

use App\Domain\Title;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_created_from_string(): void
    {
        //given
        $titleString = 'title';

        //when
        $title = Title::fromString($titleString);

        //then
        $this->assertEquals($titleString, $title->asString());
    }

    /**
     * @test
     */
    public function it_cannot_be_created_when_string_longer_than_100_characters(): void
    {
        //then
        $this->expectException(\InvalidArgumentException::class);

        //given
        $invalidTitleString = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

        //when
        Title::fromString($invalidTitleString);
    }
}
