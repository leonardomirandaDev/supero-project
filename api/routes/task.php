<?php
namespace Routers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Models\Task;

//========================================================================================================
//                                              POST
//========================================================================================================

$app->post('/task/new', function (Request $request, Response $response, array $args) {
    $args = $request->getParams();
    // check if args are set
    if (
        !isset($args['title']) && empty($args['title']) &&
        !isset($args['description'])
    ){
        return json_encode( array( "ok" => false, "error" => "Alguns campos nao foram fornecidos" ) );
    }

    $task = new Task();
    // attr
    $task->title = $args['title'];
    $task->description = $args['description'];
    // try new
    $result = $task->new();
    
    return json_encode( array( "ok" => $result, "error" => $task->lastError ) );
});

//========================================================================================================
//                                              GET
//========================================================================================================

$app->get('/task/{id}', function (Request $request, Response $response, array $args) {
    // check if args are set
    if ( !isset($args['id']) && empty($args['id']) ) {
        return json_encode( array( "ok" => false, "error" => "Alguns campos nao foram fornecidos" ) );
    }
    $task = new Task();
    // try getById
	$result = $task->getById($id);
    
    return json_encode( array( "ok" => $result, "error" => $task->lastError ) );
});

$app->get('/task', function (Request $request, Response $response, array $args) {

    $task = new Task();
    // try getAll
	$result = $task->getAll();
    
    return json_encode( array( "ok" => $result, "error" => $task->lastError ) );
});

//========================================================================================================
//                                              PUT
//========================================================================================================

$app->put('/task/change', function (Request $request, Response $response, array $args) {
    $args = $request->getParams();
    // check if args are set
    if (
        !isset($args['id']) && empty($args['id']) &&
        !isset($args['title']) && empty($args['title']) &&
        !isset($args['description'])
    ){
        return json_encode( array( "ok" => false, "error" => "Alguns campos nao foram fornecidos" ) );
    }

    $task = new Task();
    // attr
    $task->title = $args['title'];
    $task->description = $args['description'];
    // try change
    $result = $task->change($args['id']);
    
    return json_encode( array( "ok" => $result, "error" => $task->lastError ) );
});

$app->put('/task/finish', function (Request $request, Response $response, array $args) {
    $args = $request->getParams();
    // check if args are set
    if ( !isset($args['id']) && empty($args['id']) ){
        return json_encode( array( "ok" => false, "error" => "Alguns campos nao foram fornecidos" ) );
    }

    $task = new Task();
    // try finish
    $result = $task->finish($args['id']);
    
    return json_encode( array( "ok" => $result, "error" => $task->lastError ) );
});

$app->put('/task/restart', function (Request $request, Response $response, array $args) {
    $args = $request->getParams();
    // check if args are set
    if ( !isset($args['id']) && empty($args['id'])){
        return json_encode( array( "ok" => false, "error" => "Alguns campos nao foram fornecidos" ) );
    }

    $task = new Task();
    // try restart
    $result = $task->restart($args['id']);
    
    return json_encode( array( "ok" => $result, "error" => $task->lastError ) );
});

$app->put('/task/remove', function (Request $request, Response $response, array $args) {
    $args = $request->getParams();
    // check if args are set
    if ( !isset($args['id']) && empty($args['id'])){
        return json_encode( array( "ok" => false, "error" => "Alguns campos nao foram fornecidos" ) );
    }

    $task = new Task();
    // try remove
    $result = $task->remove($args['id']);
    
    return json_encode( array( "ok" => $result, "error" => $task->lastError ) );
});