<?php
namespace App\Controller;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Core\Domain\Entity\Book;
use App\Core\Application\Command\AddBook;
use App\Core\Application\Command\RemoveBook;
use App\Core\Application\Query\FindAllBooks;

class BookController
{
    /**
     * @var AddBook
     */
    private $addBookCommand;

    /**
     * @var RemoveBook
    */
    private $removeBookCommand;

    /**
     * @var FindAllBooks
     */
    private $findAllBooksQuery;
    /**
     * BookController constructor.
     *
     * @param AddBook      $addBookCommand
     * @param FindAllBooks $findAllBooksQuery
     */
    public function __construct(AddBook $addBookCommand, FindAllBooks $findAllBooksQuery, RemoveBook $removeBookCommand)
    {   
        $this->removeBookCommand = $removeBookCommand;
        $this->addBookCommand = $addBookCommand;
        $this->findAllBooksQuery = $findAllBooksQuery;
    }
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function addBook(Request $request, Response $response): Response
    {
        $body= $request->getParsedBody();
        var_dump($body);
   
        $book = $this->addBookCommand->execute($body['title'], $body['author']);
        return $response->withStatus(201, sprintf('Book id est crée', $book->getId()));
    }
    /**
     * @param Response $response
     *
     * @return Response
     */
    public function listBooks(Response $response): Response
    {
        $books = $this->findAllBooksQuery->execute();
        $bookData = array_map(function (Book $book) {
            return $book->toArray();
        }, $books);
        $payload = json_encode($bookData);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
    * @param Request $request
    * @param Response $response
    *
    * @return Response
    */
    public function removeBook(Request $request, Response $response, int $id): Response{

        $id = $this->removeBookCommand->execute($id);
        return $response->withStatus(201, sprintf('Book est supprimer', $id));
    }
}