<?php
namespace App\Core\Application\Command;

use App\Core\Application\Port\UserRepositoryInterface;
use App\Core\Domain\Entity\User;

class AddUser
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * AddUser constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * @param string $name
     *
     * @return User
     */
    public function execute(string $name): User
    {
        return $this->userRepository->addUser($name);
    }
}