<?php

namespace MarBSzot\Banking\Infrastructure;

use MarBSzot\Banking\Domain\AccountId;
use MarBSzot\Banking\Domain\BankAccount;
use MarBSzot\Banking\Domain\BankAccountRepository;

class InMemoryBankAccountRepository implements BankAccountRepository
{
    private array $accounts;

    public function add(BankAccount $account): void
    {
        $this->accounts[$account->id()] = $account;
    }
    public function ofId(AccountId $id): BankAccount
    {
        return $this->accounts[$id];
    }
}