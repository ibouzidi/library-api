<?php

namespace App\Core\Application\Port;

use App\Core\Domain\Entity\User;


interface UserRepositoryInterface
{
    /**
     * @return User[]
     */
    public function findAll(): array;
    /**
     * @param string $name
     *
     * @return User
     */
    public function addUser(string $name): User;
}