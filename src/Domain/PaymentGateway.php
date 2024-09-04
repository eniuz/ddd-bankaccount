<?php

namespace MarBSzot\Banking\Domain;

interface PaymentGateway
{
    public function receive(array $payload);
    public function create(array $payload);
}