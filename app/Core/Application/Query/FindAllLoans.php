<?php
namespace App\Core\Application\Query;
use App\Core\Application\Port\LoanRepositoryInterface;
use App\Core\Domain\Entity\Loan;

class FindAllLoans
{
    /**
     * @var LoanRepositoryInterface
     */
    private $loanRepository;
    /**
     * FindAllLoans constructor.
     *
     * @param LoanRepositoryInterface $loanRepository
     */
    public function __construct(LoanRepositoryInterface $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }
    /**
     * @return Loan[]
     */
    public function execute(): array
    {
        return $this->loanRepository->findAll();
    }
}