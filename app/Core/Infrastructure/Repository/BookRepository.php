<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Application\Port\AppRepositoryInterface;
use App\Core\Application\Port\BookRepositoryInterface;
use App\Core\Domain\Entity\Book;
class BookRepository implements BookRepositoryInterface
{
    /**
     * @var Book[]
     */
    private $books;

    /**
     * @var AppRepositoryInterface
     */
    private $appRepository;

    /**
     * @var string
     */
    private $path;
    
    public function __construct(AppRepositoryInterface $appRepository)
    {   
        $this->path = dirname(dirname(dirname(dirname(__DIR__)))) . DIRECTORY_SEPARATOR . 'data.json';
        $this->appRepository = $appRepository;
        $this->readFile();
    }
    /**
     * {@inheritDoc}
     */
    public function findAll(): array
    {
        return $this->books;
    }
    /**
     * {@inheritDoc}
     */
    public function addBook(string $title, string $author): Book
    {
        $id = count($this->books) + 1;
        $book = new Book($id, $title, $author);
        $this->books[] = $book;
        $this->appRepository->setBooks($this->books);
        $this->appRepository->writeFile();
        return $book;
    }
    private function readFile(): void
    {
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
                $this->sortBookByTitle();
            }
        }
    }

    private function sortBookByTitle(){
        usort($this->books, function($a, $b){
            return strcmp(strtolower($a->getTitle()), strtolower($b->getTitle()));
        });
    }


    public function removeBook(string $id){

        $this->books = array_filter($this->books, function ($book) use ($id){
            return $book->getId() != $id;
        });
        $this->appRepository->setBooks($this->books);
        $this->appRepository->writeFile();
        
        return $id;
    }

}