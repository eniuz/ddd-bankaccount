<?php

namespace MarBSzot\Banking\Domain;

use MarBSzot\Banking\Domain\Money;
use MarBSzot\Banking\Domain\PaymentType;

class Payment
{
    public function __construct(
        private PaymentId $paymentId, 
        private Money $amount, 
        private PaymentType $type,
        private \DateTimeImmutable $createdAt,
    )
    {
    }
    public function paymentId(): string
    {
        return $this->paymentId;
    }
    public function amount(): float
    {
        return $this->amount->amount();
    }
    public function type(): PaymentType
    {
        return $this->type();
    }
    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

}
