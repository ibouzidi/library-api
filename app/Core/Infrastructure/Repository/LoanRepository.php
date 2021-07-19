<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Application\Port\AppRepositoryInterface;
use App\Core\Application\Port\LoanRepositoryInterface;
use App\Core\Domain\Entity\Loan;

class LoanRepository implements LoanRepositoryInterface
{
    /**
     * @var Loan[]
     */
    private $loans;

    /**
     * @var AppRepositoryInterface
     */
    private $appRepository;

    /**
     * @var string
     */
    private $path;
    
    public function __construct(AppRepositoryInterface $appRepository)
    {   
        $this->path = dirname(dirname(dirname(dirname(__DIR__)))) . DIRECTORY_SEPARATOR . 'data.json';
        $this->appRepository = $appRepository;
        $this->readFile();
    }
    /**
     * {@inheritDoc}
     */
    public function findAll(): array
    {
        return $this->loans;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addLoan(string $bookId, string $userId): Loan
    {
        $id = count($this->loans) + 1;
        $loan = new Loan($id, $bookId, $userId);
        $this->loans[] = $loan;
        $this->appRepository->setLoans($this->loans);
        $this->appRepository->writeFile();
        return $loan;
    }
    
    private function readFile(): void
    {
        $this->loans = [];
        $raw = file_get_contents($this->path);
        if (!empty($raw)) {
            $data = json_decode($raw, true)['loans'];
            foreach ($data as $item) {
                $this->loans[] = new Loan(
                    $item['id'],
                    $item['book_id'],
                    $item['user_id']
                );
            }
        }
    }


}