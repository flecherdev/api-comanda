<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\cd;
use App\Models\ORM\cdApi;


include_once __DIR__ . '/../../src/app/modelORM/cd.php';
include_once __DIR__ . '/../../src/app/modelORM/cdControler.php';

return function (App $app) {
    $container = $app->getContainer();

     $app->group('/cdORM', function () { 

      // $this->get('/', cdControler::class . '::TraerTodos()');
         
      $this->get('/', function ($request, $response, $args) {
        $todosLosCds=cd::all();
        $newResponse = $response->withJson($todosLosCds, 200);  
        return $newResponse;
      });

      $this->get('/{id}', function ($request, $response, $args) {
        $traerUno = cd::find($args['id']);
        $newResponse = $response->withJson($traerUno, 200);  
        return $newResponse;
      });

      $this->post('/add', function ($request, $response, $args) {
        $dato = $request->getParseBody();
        $cd = cd::create(['cd' => $dato['cd']]);
        $newResponse = $response->withJson($cd , 200);  
      });
      
    });


     $app->group('/cdORM2', function () {   

        $this->get('/',cdApi::class . ':traerTodos');
   
    });

};