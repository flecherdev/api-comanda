<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\cd;
use App\Models\ORM\empleado;
use App\Models\ORM\Estado;

use App\Models\ORM\cdControler;
use App\Models\ORM\empleadoControler;
use App\Models\ORM\EstadoControler;

include_once __DIR__ . '/../../src/app/modelORM/cd.php';
include_once __DIR__ . '/../../src/app/modelORM/cdControler.php';
include_once __DIR__ . '/../../src/app/modelORM/empleadoControler.php';
include_once __DIR__ . '/../../src/app/modelORM/estadoControler.php';

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

    // Empleado
    $app->group('/empleado-orm', function () { 
      $this->get('/', empleadoControler::class . ':TraerTodos');
      $this->get('/empleado/[{id}]', empleadoControler::class . ':TraerUno'); 
      $this->post('/empleado/add', empleadoControler::class . ':CargarUno'); 
      $this->delete('/empleado/delete/[{id}]', empleadoControler::class . ':BorrarUno');  
      $this->put('/empleado/[{id}]', empleadoControler::class . ':ModificarUno');   
    });

    // Estado
    $app->group('/estado-orm', function () { 
      $this->get('/', EstadoControler::class . ':TraerTodos');
      $this->get('/estado/[{id}]', EstadoControler::class . ':TraerUno'); 
      $this->post('/estado/add', EstadoControler::class . ':CargarUno'); 
      $this->delete('/estado/delete/[{id}]', EstadoControler::class . ':BorrarUno');  
      $this->put('/estado/[{id}]', EstadoControler::class . ':ModificarUno');   
    });

};