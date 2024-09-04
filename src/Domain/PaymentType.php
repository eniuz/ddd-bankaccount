<?php 

namespace MarBSzot\Banking\Domain;

enum PaymentType
{
    case DEBIT;
    case CREDIT;
    
    public function type(): string
    {
        return match($this) 
        {
            PaymentType::DEBIT => 'debit',   
            PaymentType::CREDIT => 'credit',
        };
    }
}