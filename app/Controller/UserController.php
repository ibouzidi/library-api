<?php
namespace App\Controller;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Core\Application\Command\AddUser;
use App\Core\Application\Query\FindAllUsers;
use App\Core\Domain\Entity\User;

class UserController
{
    /**
     * @var AddUser
     */
    private $addUserCommand;
    /**
     * @var FindAllUsers
     */
    private $findAllUsersQuery;
    /**
     * UserController constructor.
     *
     * @param AddUser      $addUserCommand
     * @param FindAllUsers $findAllUsersQuery
     */
    public function __construct(AddUser $addUserCommand, FindAllUsers $findAllUsersQuery)
    {
        $this->addUserCommand = $addUserCommand;
        $this->findAllUsersQuery = $findAllUsersQuery;
    }
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function addUser(Request $request, Response $response): Response
    {
        $body= $request->getParsedBody();
        var_dump($body);
   
        $user = $this->addUserCommand->execute($body['name']);
        return $response->withStatus(201, sprintf('User id est crée', $user->getId()));
    }
    /**
     * @param Response $response
     *
     * @return Response
     */
    public function listUsers(Response $response): Response
    {
        $users = $this->findAllUsersQuery->execute();
        $userData = array_map(function (User $user) {
            return $user->toArray();
        }, $users);
        $payload = json_encode($userData);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}