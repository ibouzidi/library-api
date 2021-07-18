<?php
namespace App\Controller;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Core\Application\Command\AddLoan;
use App\Core\Application\Query\FindAllLoans;
use App\Core\Domain\Entity\Loan;

class LoanController
{
    /**
     * @var AddLoan
     */
    private $addLoanCommand;
    /**
     * @var FindAllLoans
     */
    private $findAllLoansQuery;
    /**
     * LoanController constructor.
     *
     * @param AddLoan      $addLoanCommand
     * @param FindAllLoans $findAllLoansQuery
     */
    public function __construct(AddLoan $addLoanCommand, FindAllLoans $findAllLoansQuery)
    {
        $this->addLoanCommand = $addLoanCommand;
        $this->findAllLoansQuery = $findAllLoansQuery;
    }
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function addLoan(Request $request, Response $response): Response
    {
        $body= $request->getParsedBody();
        var_dump($body);
   
        $loan = $this->addLoanCommand->execute($body['book_id'], $body['user_id']);
        return $response->withStatus(201, sprintf('Loan id est crée', $loan->getId()));
    }
    /**
     * @param Response $response
     *
     * @return Response
     */
    public function listLoans(Response $response): Response
    {
        $loans = $this->findAllLoansQuery->execute();
        $loanData = array_map(function (Loan $loan) {
            return $loan->toArray();
        }, $loans);
        $payload = json_encode($loanData);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}