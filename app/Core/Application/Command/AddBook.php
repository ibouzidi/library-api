<?php
namespace App\Core\Application\Command;

use App\Core\Application\Port\BookRepositoryInterface;
use App\Core\Domain\Entity\Book;

class AddBook
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
     * @param string $title
     * @param string $author
     *
     * @return Book
     */
    public function execute(string $title, string $author): Book
    {
        return $this->bookRepository->addBook($title, $author);
    }
}