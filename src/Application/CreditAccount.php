<?php

namespace MarBSzot\Banking\Application;

use MarBSzot\Banking\Domain\AccountId;
use MarBSzot\Banking\Domain\Money;

class CreditAccount
{
    public function __construct(
        private AccountId $accountId, 
        private Money $money)
    {
    }

    public function accountId():string
    {
        return (string) $this->accountId;
    }

    public function amount() : Money {
        return $this->money;
    }
}