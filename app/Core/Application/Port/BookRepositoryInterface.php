<?php

namespace App\Core\Application\Port;

use App\Core\Domain\Entity\Book;


interface BookRepositoryInterface
{
    /**
     * @return Book[]
     */
    public function findAll(): array;
    /**
     * @param string $title
     * @param string $author
     *
     * @return Book
     */
    public function addBook(string $title, string $author): Book;

}