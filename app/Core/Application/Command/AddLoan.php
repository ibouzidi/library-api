<?php
namespace App\Core\Application\Command;

use App\Core\Application\Port\LoanRepositoryInterface;
use App\Core\Domain\Entity\Loan;

class AddLoan
{
    /**
     * @var LoanRepositoryInterface
     */
    private $LoanRepository;
    /**
     * AddLoan constructor.
     *
     * @param LoanRepositoryInterface $LoanRepository
     */
    public function __construct(LoanRepositoryInterface $LoanRepository)
    {
        $this->LoanRepository = $LoanRepository;
    }
    /**
     * @param string $bookId
     * @param string $userId
     *
     * @return Loan
     */
    public function execute(string $bookId, string $userId): Loan
    {
        return $this->LoanRepository->addLoan($bookId, $userId);
    }
}