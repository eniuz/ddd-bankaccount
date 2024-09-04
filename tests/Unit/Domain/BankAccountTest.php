<?php

use PHPUnit\Framework\TestCase;
use MarBSzot\Banking\Domain\BankAccount;
use MarBSzot\Banking\Domain\InvalidCurrencyException;
use MarBSzot\Banking\Domain\InsufficientFundsException;
use MarBSzot\Banking\Domain\Money;
use MarBSzot\Banking\Domain\NegativeFundsException;

class BankAccountTest extends TestCase
{
    private ?BankAccount $bankAccount = null;

    protected function setUp(): void
    {
        $credit = new Money(0.00, 'EUR');
        $this->bankAccount = new BankAccount('0000031216412874', $credit);
    }

    protected function tearDown(): void
    {
        $this->bankAccount = null;
    }

    public function testCanCreditAccount()
    {
        $credit = new Money(200.15, 'EUR');
        $this->bankAccount->credit($credit);

        $this->assertEquals(
            $credit->amount(),
            $this->bankAccount->balance()
        );
    }
    public function testDebitsAccountWithAChargeOfFivePercent()
    {
        $expectedBalance = new Money(190, 'EUR');

        $this->bankAccount->credit(new Money(400, 'EUR'));
        $this->bankAccount->debit(new Money(200, 'EUR'));

        $this->assertEquals(
            $expectedBalance->amount(),
            $this->bankAccount->balance()
        );
    }
    public function testThrowsWhenChosenCurrencyIsInvalid()
    {
        $this->expectException(InvalidCurrencyException::class);
        $this->bankAccount->debit(new Money(200.15, 'GBP'));
    }

    public function testThrowsOnDebitWhenThereIsNotEnoughFunds()
    {
        $this->expectException(InsufficientFundsException::class);
        $this->bankAccount->debit(new Money(400.15, 'EUR'));
    }

    public function testCreditCannotBeNegative()
    {
        $this->expectException(NegativeFundsException::class);
        $this->bankAccount->credit(new Money(-400.25, 'EUR'));
    }
}

