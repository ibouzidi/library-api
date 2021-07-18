<?php

namespace App\Core\Application\Port;

use App\Core\Domain\Entity\Loan;


interface LoanRepositoryInterface
{
    /**
     * @return loan[]
     */
    public function findAll(): array;
    /**
     * @param string $bookId
     * @param string $userId
     *
     * @return Loan
     */
    public function addLoan(string $bookId, string $userId): Loan;

}