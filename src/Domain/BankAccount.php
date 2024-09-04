<?php

declare(strict_types=1);

namespace MarBSzot\Banking\Domain;

use MarBSzot\Banking\Domain\InvalidCurrencyException;
use MarBSzot\Banking\Domain\InsufficientFundsException;
use MarBSzot\Banking\Domain\Money;

class BankAccount
{
    public function __construct(
        private string $accountId,
        private Money $balance
    ) {
    }
    public function id(): string
    {
        return $this->accountId;
    }

    public function credit(Money $money): void
    {
        if ($this->balance->currency() !== $money->currency()) {
            throw new InvalidCurrencyException(sprintf('Given %s is different that account currency', $money->currency()));
        }

        if ($money->isNegative()) {
            throw new NegativeFundsException(
                'Amount given cannot be negative'
            );
        }

        $this->balance = new Money(
            $this->balance() + $money->amount(),
            $this->balance->currency()
        );

    }

    public function debit(Money $money): void
    {
        if ($this->balance->currency() !== $money->currency()) {
            throw new InvalidCurrencyException(
                sprintf(
                    'Given %s is different that account currency',
                    $money->currency()
                )
            );
        }


        $newBalance = new Money(
            $this->balance() - ($money->amount() * 1.05),
            $this->balance->currency()
        );

        if ($newBalance->isNegative()) {
            throw new InsufficientFundsException('you have no funds to make this operation');
        }

        $this->balance = $newBalance;
    }

    public function balance(): float
    {
        return $this->balance->amount();
    }
}
