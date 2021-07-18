<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Application\Port\AppRepositoryInterface;
use App\Core\Application\Port\UserRepositoryInterface;
use App\Core\Domain\Entity\User;
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User[]
     */
    private $users;
    /**
     * @var string
     */
    private $path = 'C:\xampp\htdocs\projetslim\library-api\data.json';
    
    public function __construct(AppRepositoryInterface $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->readFile();
    }
    /**
     * {@inheritDoc}
     */
    public function findAll(): array
    {
        return $this->users;
    }
    /**
     * {@inheritDoc}
     */
    public function addUser(string $name): User
    {
        $id = count($this->users) + 1;
        $user = new User($id, $name);
        $this->users[] = $user;
        $this->appRepository->setUsers($this->users);
        $this->appRepository->writeFile();
        return $user;
    }
    private function readFile(): void
    {
        $this->users = [];
        $raw = file_get_contents($this->path);
        if (!empty($raw)) {
            $data = json_decode($raw, true)['users'];
     
            foreach ($data as $item) {
                ksort($item);
                $this->users[] = new User(
                    $item['id'],
                    $item['name']
                );
                $this->sortUserByName();
            }
        }
    }

    private function sortUserByName(){

        usort($this->users, function($a, $b){
            return strcmp(strtolower($a->getName()), strtolower($b->getName()));
        });
    }
}