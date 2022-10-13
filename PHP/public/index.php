<?php

require_once('../src/utils/autoload.php');
require_once('../src/utils/errorHandler.php');

use src\router\Router;

/** @var Router $Router */
$Router = new Router('/app');

$Router->get('/pessoa', src\controller\ControllerPessoa::class, 'getAll');
$Router->post('/pessoa', src\controller\ControllerPessoa::class, 'insert');
$Router->put('/pessoa', src\controller\ControllerPessoa::class, 'update');
$Router->delete('/pessoa', src\controller\ControllerPessoa::class, 'delete');

$Router->get('/pessoa/count', src\controller\ControllerPessoa::class, 'getQtd');

$Router->start();

