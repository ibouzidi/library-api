<?php
namespace App\Core\Application\Query;
use App\Core\Application\Port\UserRepositoryInterface;
use App\Core\Domain\Entity\User;

class FindAllUsers
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * FindAllUsers constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * @return User[]
     */
    public function execute(): array
    {
        return $this->userRepository->findAll();
    }
}