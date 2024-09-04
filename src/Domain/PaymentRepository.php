<?php
namespace MarBSzot\Banking\Domain;

use MarBSzot\Banking\Domain\Payment;
use MarBSzot\Banking\Domain\PaymentId;

interface PaymentRepository
{
    /** @return array<Payment> | array{} */
    public function findAll(): array;
    public function ofId(PaymentId $paymentId): Payment | null;
    public function add(Payment $payment): void;
    /** @todo - Change to UUID */
    public function generateId(): string;
    /** @return array<Payment> | array{} */
    public function findLastThreeTransactions(): array;
}