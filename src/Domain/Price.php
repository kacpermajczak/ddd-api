<?php

declare(strict_types=1);

namespace App\Domain;

use Assert\Assert;
use Money\Currency;
use Money\Money;

final class Price
{
    private Money $money;

    private function __construct(Money $money)
    {
        $this->money = $money;
    }

    public static function fromString(string $price): Price
    {
        $splitPrice = explode(' ', $price);
        //amount and currency
        Assert::that($splitPrice)->count(2);

        $amount = $splitPrice[0];
        $currencyCode = $splitPrice[1];

        Assert::that($amount)->greaterOrEqualThan(0);

        return new self(new Money($amount, new Currency($currencyCode)));
    }

    public function asString(): string
    {
        return $this->money->getAmount().' '.$this->money->getCurrency()->getCode();
    }

    public function greaterThan(Price $price): bool
    {
        return $this->money->greaterThan($price->money);
    }
}
