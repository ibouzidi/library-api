<?php
namespace App\Core\Application\Query;
use App\Core\Application\Port\BookRepositoryInterface;
use App\Core\Domain\Entity\Book;

class FindAllBooks
{
    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;
    /**
     * FindAllBooks constructor.
     *
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
    /**
     * @return Book[]
     */
    public function execute(): array
    {
        return $this->bookRepository->findAll();
    }
}