<?php

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use DI\ContainerBuilder;
use function DI\autowire;
use DI\Bridge\Slim\Bridge;
use Slim\Views\PhpRenderer;


use App\Controller\BookController;
use App\Controller\LoanController;
use App\Controller\UserController;
use App\Controller\IndexController;
use App\Core\Application\Port\AppRepositoryInterface;
use App\Core\Infrastructure\Repository\AppRepository;
use App\Core\Application\Port\BookRepositoryInterface;
use App\Core\Application\Port\LoanRepositoryInterface;
use App\Core\Application\Port\UserRepositoryInterface;
use App\Core\Infrastructure\Repository\BookRepository;
use App\Core\Infrastructure\Repository\LoanRepository;
use App\Core\Infrastructure\Repository\UserRepository;

require __DIR__ . '/vendor/autoload.php';



// Set up container, which uses PHP-DI autowiring
$builder = new ContainerBuilder();
$builder
    ->addDefinitions([
        //manual interface resolution
        BookRepositoryInterface::class => autowire(BookRepository::class),
        UserRepositoryInterface::class => autowire(UserRepository::class),
        AppRepositoryInterface::class => autowire(AppRepository::class),
        LoanRepositoryInterface::class => autowire(LoanRepository::class),
        //set template path
        PhpRenderer::class => autowire()->constructor('public')
    ]);
$container = $builder->build();


//create app
$app = Bridge::create($container);
//automatically parse data posted in JSON, XML or form encoded format

$app->addBodyParsingMiddleware();

// $app->addErrorMiddleware(true, true, true);
//routing

// $app->get('/', function (Request $request, Response $response) {
//     $rpo = new AppRepository();
//     $allData = $rpo->findAll();
//     var_dump($allData);
//     return $response;
// });




//frontend routes
$app->get('/', [IndexController::class, 'index']);


$app->get('/api/books', [BookController::class, 'listBooks']);
$app->post('/api/books', [BookController::class, 'addBook']);

$app->get('/api/users', [UserController::class, 'listUsers']);
$app->post('/api/users', [UserController::class, 'addUser']);

$app->get('/api/loans', [LoanController::class, 'listLoans']);
$app->post('/api/loans', [LoanController::class, 'addLoan']);

$app->get('/{sth}', [IndexController::class, 'index']);

$app->run();
