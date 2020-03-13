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
$app->setBasePath('/~ephp062/slim');

// Create our PHP renderer object
$view = new \Slim\Views\PhpRenderer('views');

// Set up a simple 'hello' route.
$app->get('/', function(Request $req, Response $res, array $args) use($conn) {
    $stmt = $conn->query("SELECT * FROM wadsongs");
    
    $songs = "";
    while($row = $stmt->fetch()) {
        $songs .= $row['title'];
    };
    $res->getBody()->write("$songs");
    return $res;
});

$app->get('/artist/{artist}', function(Request $req, Response $res, array $args) use($conn) {
    $stmt = $conn->prepare("SELECT * FROM wadsongs WHERE artist=?");
    $stmt->execute([$args["artist"]]);

    $songs = "";
    while($row = $stmt->fetch()) {
        $songs .= $row['title'];
    };
    $res->getBody()->write("$songs");
    return $res;
});

$app->get('/artist/{artist}/song/{song}', function(Request $req, Response $res, array $args) use($conn) {
    $stmt = $conn->prepare("SELECT * FROM wadsongs WHERE artist=? AND song=?");
    $stmt->execute([$args["artist"], $args["song"]]);

    $songs = "";
    while($row = $stmt->fetch()) {
        $songs .= $row['title'];
    };
    $res->getBody()->write("$songs");
    return $res;
});

$app->post('/addsong', function (Request $req, Response $res, array $args) use($conn) {
    $post = $req->getParsedBody();

    $stmt = $conn->prepare("INSERT INTO wadsongs (title, artist) VALUES (?, ?)");
    $stmt->execute([$args["title"], $args["artist"]]);

    $body = $post['title'];
    $body .= $post['artist'];
    $res->getBody()->write("$body");
    return $res;
});

$app->get('/inputsong', function (Request $req, Response $res, array $args) use($conn, $view) { 
    $res = $view->render($res, 'songform.phtml', []);
    return $res;
});

$app->get('/song/{id}', function (Request $req, Response $res, array $args) use($conn, $view) {
    $stmt = $conn->prepare("SELECT * FROM wadsongs WHERE id=?");
    $stmt->execute([$args['id']]);

    $res = $view->render($res, 'song.phtml', ['results'=>$stmt]);
    return $res;
});

$app->run();