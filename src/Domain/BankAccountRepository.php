<?php

namespace MarBSzot\Banking\Domain;

use MarBSzot\Banking\Domain\AccountId;

interface BankAccountRepository
{
    public function add(BankAccount $account): void;
    public function ofId(AccountId $id): BankAccount;
}
