<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\cd;
// use App\Models\ORM\cdApi;
use App\Models\ORM\cdControler;

include_once __DIR__ . '/../../src/app/modelORM/cd.php';
include_once __DIR__ . '/../../src/app/modelORM/cdControler.php';

return function (App $app) {
    $container = $app->getContainer();

    // A modo de ejemplo
    $app->group('/cdORM', function () { 
      $this->get('/', cdControler::class . ':TraerTodos'); //ok
      $this->get('/cd/[{id}]', cdControler::class . ':TraerUno'); //ok
      $this->post('/cd/add', cdControler::class . ':CargarUno'); //0k
      $this->delete('/cd/delete/[{id}]', cdControler::class . ':BorrarUno');  
      $this->put('/cd/[{id}]', cdControler::class . ':ModificarUno');   
    });

};