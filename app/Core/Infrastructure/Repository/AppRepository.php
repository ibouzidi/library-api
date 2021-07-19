<?php

namespace App\Core\Infrastructure\Repository;
use App\Core\Domain\Entity\Book;
use App\Core\Domain\Entity\User;
use App\Core\Domain\Entity\Loan;
use App\Core\Application\Port\AppRepositoryInterface;

class AppRepository implements AppRepositoryInterface
{
    /**
     * @var Book[]
     */
    private $books;

    /**
     * @var User[]
     */
    private $users;

    /**
     * @var array
     */
    private $allData;

    /**
     * @var loans[]
    */
    private $loans;

    /**
     * @var string
     */
    private $path;
    
    public function __construct()
    {   
        $this->path = dirname(dirname(dirname(dirname(__DIR__)))) . DIRECTORY_SEPARATOR . 'data.json';
        $this->readFile();
    }
    /**
     * {@inheritDoc}
     */
    public function findAll(): array
    {
        $this->allData = [];
        $this->allData['users'] = $this->users;
        $this->allData['books'] = $this->books;
        $this->allData['loans'] = $this->loans;
        return $this->allData;
    }

    private function readFile(): void
    {
        $this->users = [];
        $this->books = [];
        $raw = file_get_contents($this->path);
        if (!empty($raw)) {
            $data = json_decode($raw, true)['books'];
            foreach ($data as $item) {
                $this->books[] = new Book(
                    $item['id'],
                    $item['title'],
                    $item['author']
                );
            }
        }
        if (!empty($raw)) {
            $data = json_decode($raw, true)['users'];
            foreach ($data as $item) {
                $this->users[] = new User(
                    $item['id'],
                    $item['name'],
                );
            }
        }
        if (!empty($raw)) {
            $data = json_decode($raw, true)['loans'];
            foreach ($data as $item) {
                $this->loans[] = new Loan(
                    $item['id'],
                    $item['book_id'],
                    $item['user_id'],
                );
            }
        }

    }

    public function writeFile()
    {
        $books = array_map(function (Book $book) {
            return $book->toArray();
        }, $this->books);
        $users = array_map(function (User $user) {
            return $user->toArray();
        }, $this->users);
        $loans = array_map(function (Loan $loan) {
        return $loan->toArray();
        }, $this->loans);

        $this->allData = [];
        $this->allData['users'] = $users;
        $this->allData['books'] = $books;
        $this->allData['loans'] = $loans;


        file_put_contents($this->path, json_encode($this->allData));
    }

    public function setBooks(array $books)
    {
        $this->books = $books;
    }

    public function setUsers(array $users)
    {
        $this->users = $users;
    }
    public function setLoans(array $loans)
    {
        $this->loans = $loans;
    }

}