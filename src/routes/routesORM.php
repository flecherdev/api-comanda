<?php

use Slim\App;

use App\Models\ORM\empleadoControler;
use App\Models\ORM\EstadoControler;
use App\Models\ORM\TipoControler;
use App\Models\ORM\MesaControler;
use App\Models\ORM\MenuControler;
use App\Models\ORM\EstadoMesaControler;
use App\Models\ORM\FichadaControler;
use App\Models\ORM\PedidoControler;

include_once __DIR__ . '/../../src/app/controlers/empleadoControler.php';
include_once __DIR__ . '/../../src/app/controlers/estadoControler.php';
include_once __DIR__ . '/../../src/app/controlers/tipoControler.php';
include_once __DIR__ . '/../../src/app/controlers/mesaControler.php';
include_once __DIR__ . '/../../src/app/controlers/menuControler.php';
include_once __DIR__ . '/../../src/app/controlers/estadoMesaControler.php';
include_once __DIR__ . '/../../src/app/controlers/fichadaControler.php';
include_once __DIR__ . '/../../src/app/controlers/pedidoControler.php';

return function (App $app) {
    $container = $app->getContainer();

    // Login
    $app->post('/empleados/login', empleadoControler::class . ':LoginNombrePass');  

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
      $this->get('/', EstadoMesaControler::class . ':TraerTodos');
      $this->get('/estado-mesa/[{id}]', EstadoMesaControler::class . ':TraerUno'); 
      $this->post('/estado-mesa/add', EstadoMesaControler::class . ':CargarUno'); 
      $this->delete('/estado-mesa/delete/[{id}]', EstadoMesaControler::class . ':BorrarUno');  
      $this->put('/estado-mesa/[{id}]', EstadoMesaControler::class . ':ModificarUno');   
    });

    // Fichada
    $app->group('/fichada-orm', function () { 
      $this->get('/', FichadaControler::class . ':TraerTodos');
      $this->get('/fichada/[{id}]', FichadaControler::class . ':TraerUno'); 
      $this->post('/fichada/add', FichadaControler::class . ':CargarUno'); 
      $this->delete('/fichada/delete/[{id}]', FichadaControler::class . ':BorrarUno');  
      $this->put('/fichada/[{id}]', FichadaControler::class . ':ModificarUno');   
    });

    // Pedido
    $app->group('/pedido-orm', function () { 
      $this->get('/', PedidoControler::class . ':TraerTodos');
      $this->get('/pedido/[{id}]', PedidoControler::class . ':TraerUno'); 
      $this->post('/pedido/add', PedidoControler::class . ':CargarUno'); 
      $this->delete('/pedido/delete/[{id}]', PedidoControler::class . ':BorrarUno');  
      $this->put('/pedido/[{id}]', PedidoControler::class . ':ModificarUno');   
    });
};