<?php

namespace MarBSzot\Banking\Domain;

final class Money
{
    private float $amount;
    private string $currency;

    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function amount(): float
    {
        return (float) $this->amount;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function isNegative(): bool
    {
        return $this->amount < 0;
    }
    public function add(Money $money): Money
    {
        return new self(
            $this->amount + $money->amount(),
            $this->currency,
        );
    }
    public function subtract(Money $money): Money
    {
        return new self(
            $this->amount - $money->amount(),
            $this->currency,
        );
    }
}
