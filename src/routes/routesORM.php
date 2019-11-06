<?php

use Slim\App;

use App\Models\ORM\empleadoControler;
use App\Models\ORM\EstadoControler;
use App\Models\ORM\TipoControler;
use App\Models\ORM\MesaControler;
use App\Models\ORM\MenuControler;
use App\Models\ORM\EstadoMesaControler;

include_once __DIR__ . '/../../src/app/controlers/empleadoControler.php';
include_once __DIR__ . '/../../src/app/controlers/estadoControler.php';
include_once __DIR__ . '/../../src/app/controlers/tipoControler.php';
include_once __DIR__ . '/../../src/app/controlers/mesaControler.php';
include_once __DIR__ . '/../../src/app/controlers/menuControler.php';
include_once __DIR__ . '/../../src/app/controlers/estadoMesaControler.php';

return function (App $app) {
    $container = $app->getContainer();

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

    // Tipo
    $app->group('/tipo-orm', function () { 
      $this->get('/', TipoControler::class . ':TraerTodos');
      $this->get('/tipo/[{id}]', TipoControler::class . ':TraerUno'); 
      $this->post('/tipo/add', TipoControler::class . ':CargarUno'); 
      $this->delete('/tipo/delete/[{id}]', TipoControler::class . ':BorrarUno');  
      $this->put('/tipo/[{id}]', TipoControler::class . ':ModificarUno');   
    });

    // Mesa
    $app->group('/mesa-orm', function () { 
      $this->get('/', MesaControler::class . ':TraerTodos');
      $this->get('/mesa/[{id}]', MesaControler::class . ':TraerUno'); 
      $this->post('/mesa/add', MesaControler::class . ':CargarUno'); 
      $this->delete('/mesa/delete/[{id}]', MesaControler::class . ':BorrarUno');  
      $this->put('/mesa/[{id}]', MesaControler::class . ':ModificarUno');   
    });

    // Menu
    $app->group('/menu-orm', function () { 
      $this->get('/', MenuControler::class . ':TraerTodos');
      $this->get('/menu/[{id}]', MenuControler::class . ':TraerUno'); 
      $this->post('/menu/add', MenuControler::class . ':CargarUno'); 
      $this->delete('/menu/delete/[{id}]', MenuControler::class . ':BorrarUno');  
      $this->put('/menu/[{id}]', MenuControler::class . ':ModificarUno');   
    });

    // EstadoMesa
    $app->group('/estado-mesa-orm', function () { 
      $this->get('/', estadoMesaControler::class . ':TraerTodos');
      $this->get('/estado-mesa/[{id}]', estadoMesaControler::class . ':TraerUno'); 
      $this->post('/estado-mesa/add', estadoMesaControler::class . ':CargarUno'); 
      $this->delete('/estado-mesa/delete/[{id}]', estadoMesaControler::class . ':BorrarUno');  
      $this->put('/estado-mesa/[{id}]', estadoMesaControler::class . ':ModificarUno');   
    });
};