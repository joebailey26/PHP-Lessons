<?php
require('/var/www/html/share/slim4/vendor/autoload.php');


// Import classes from the Psr library (standardised HTTP requests and responses)
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Factory\AppFactory;

require('database_connection.php');

// Create our app.
$app = AppFactory::create();

// Add routing functionality to Slim. This is not included by default and
// must be turned on.
$app->addRoutingMiddleware();

// Add error handling functionality. The three 'true's indicate:
// - first argument: display full error details
// - second argument: call Slim error handler
// - third argument: log error details

$app->addErrorMiddleware(true, true, true);
 
// For the routes to work correctly, you must set your base path.
// This is the relative path of your webspace on the server, including the
// folder you're using but NOT public_html. Here we are assuming the Slim app
// is saved in the 'slimapp' folder within 'public_html' 
$app->setBasePath('/~ephp062/slimapp');


// Set up a simple 'hello' route.
$app->get('/hello', function(Request $req, Response $res, array $args) {
    $res->getBody()->write('Hello world!');
    return $res;
});

$app->get('/time', function(Request $req, Response $res, array $args) {
    $res->getBody()->write("There have been ". time() ." milliseconds since 1/1/70.");
    return $res;
});

$app->get('/countTo/{ntimes}/step/{step}', function(Request $req, Response $res, array $args) {
    for($count=1; $count<$args['ntimes']; $count+=$args['step']) {
        $res->getBody()->write("$count <br />");
    }
    return $res;
});

$app->post('/addStudent', function (Request $req, Response $res, array $args) {
    $post = $req->getParsedBody();
    $res->getBody()->write("Student details : Name: ". $post['name']. " Username: ". $post['username']. " Course: " . $post['course']);
    return $res;
});

$app->get('/student/{studentid}', function (Request $req, Response $res, array $args) use($conn) { 
    $stmt = $conn->prepare("SELECT * FROM ht_users WHERE id=?");
    $stmt->execute([$args["studentid"]]);
    $row = $stmt->fetch();
    // withJson now needs slim/http package
    $res->getBody()->write("Student name: $row[name], Password: $row[password]");
    return $res;
});

// Create our PHP renderer object
$view = new \Slim\Views\PhpRenderer('views');

$app->get('/songs/{year}', function (Request $req, Response $res, array $args) use($conn, $view) {
    $stmt = $conn->prepare("SELECT * FROM wadsongs WHERE year=?");
    $stmt->execute([$args['year']]);

    $res = $view->render($res, 'searchresults.phtml', ['results'=>$stmt, 'year'=>$args['year']]);    
    return $res;
});

$app->run();