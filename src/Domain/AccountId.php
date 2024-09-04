<?php
namespace MarBSzot\Banking\Domain;

final class AccountId
{
    public function __construct(private string $id)
    {
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
