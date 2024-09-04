<?php

namespace MarBSzot\Banking\Infrastructure;

use MarBSzot\Banking\Domain\PaymentRepository;
use MarBSzot\Banking\Domain\Payment;
use MarBSzot\Banking\Domain\PaymentId;

class InMemoryPaymentRepository implements PaymentRepository
{
    private array $payments;
    
    /** @return array<Payment> | array{} */
    public function findAll(): array
    {
        return $this->payments;
    }
    public function ofId(PaymentId $paymentId): Payment | null
    {
        return $this->payments[$paymentId];
    }
    public function add(Payment $payment): void
    {
        $this->payments[$payment] = $payment;
    }
    /** @todo - Change to UUID */
    public function generateId(): string {
        return strval(mt_rand());
    }
    /** @return array<Payment> | array{} */
    public function findLastThreeTransactions(): array{
        return array_slice($this->payments, -3, 3, true);
    }
}