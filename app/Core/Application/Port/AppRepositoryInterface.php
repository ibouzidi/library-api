<?php

namespace App\Core\Application\Port;

use App\Core\Domain\Entity\Book;

interface AppRepositoryInterface
{
    /**
     * @return array
     */
    public function findAll(): array;

    public function writeFile();

    public function setBooks(array $books);
    public function setUsers(array $users);
    public function setLoans(array $loans);
}