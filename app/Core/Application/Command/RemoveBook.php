<?php
namespace App\Core\Application\Command;

use App\Core\Application\Port\BookRepositoryInterface;
use App\Core\Domain\Entity\Book;

class RemoveBook
{
    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;
    /**
     * AddBook constructor.
     *
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param string $id
     */
    public function execute(string $id)
    {
        return $this->bookRepository->removeBook($id);
    }
}
