<?php

namespace MarBSzot\Banking\Application;

use DateTime;
use DateTimeImmutable;
use MarBSzot\Banking\Domain\PaymentGateway;
use MarBSzot\Banking\Domain\PaymentRepository;
use MarBSzot\Banking\Domain\PaymentType;
use MarBSzot\Banking\Domain\Payment;
use MarBSzot\Banking\Domain\PaymentId;
use Throwable;
use MarBSzot\Banking\Domain\DebitLimitExceededException;

class PaymentService
{
    public function __construct(
        private PaymentGateway $paymentGateway, 
        private PaymentRepository $paymentRepository
    )
    {
        
    }
     public function debit(DebitAccount $creditAccount): void
     {
        if($this->isDebitLimitExceeded())
            throw new DebitLimitExceededException('You have exceeded debit limit');

        try {
            $this->paymentGateway->create([
                'accountId' => $creditAccount->accountId(), 
                'amount' => $creditAccount->amount()
            ]);
            $paymentId = $this->paymentRepository->generateId();
            $this->paymentRepository->add(new Payment(
                new PaymentId($paymentId),
                $creditAccount->amount(), 
                PaymentType::DEBIT,
                new DateTimeImmutable()
                )
            );
        } catch (Throwable $e) {
            throw new \Exception($e->getMessage());
        }
     }
     public function credit(CreditAccount $creditAccount): void
     {
        try {
            $this->paymentGateway->receive([
                'accountId' => $creditAccount->accountId(), 
                'amount' => $creditAccount->amount()
            ]);
            $paymentId = $this->paymentRepository->generateId();
            $this->paymentRepository->add(new Payment(
                new PaymentId($paymentId),
                $creditAccount->amount(), 
                PaymentType::CREDIT,
                new DateTimeImmutable()
                )
            );
        } catch (Throwable $e) {
            throw new \Exception($e->getMessage());
        }
     }
     private function isDebitLimitExceeded(): bool
     {
        $lastThreeTransactions = $this->paymentRepository->findLastThreeTransactions();
        $lastTransaction = end($lastThreeTransactions);
        $lastTransactionDate = $lastTransaction->format('Y-m-d');
        $currentDate = (new DateTimeImmutable())->format('Y-m-d');
        return $lastTransactionDate === $currentDate;
     }
}