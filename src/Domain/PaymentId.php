<?php

namespace MarBSzot\Banking\Domain;

final class PaymentId
{
    public function __construct(private string $id)
    {
    }

    public function __toString()
    {
        return $this->id;
    }
}