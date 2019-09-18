<?php
namespace App\Models\ORM;
use App\Models\ORM\Estado;
use App\Models\IApiControler;

include_once __DIR__ . '/estado.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class estadoControler implements IApiControler {
    
  public function TraerTodos($request, $response, $args) { 
    $todosLosEmpleados=Estado::all();
    $newResponse = $response->withJson($todosLosEmpleados, 200);  
    return $newResponse;
  }

  public function TraerUno($request, $response, $args) {
    $traerUno = Estado::find($args['id']);
    $newResponse = $response->withJson($traerUno, 200);  
    return $newResponse;
  }
   
  public function CargarUno($request, $response, $args) {  
    $dato = json_decode(json_encode($request->getParsedBody()));
    
    $miEstado = new Estado;
    $miEstado->descripcion_estado = $dato->descripcion_estado;

    $miEstado->save();

    $newResponse = $response->withJson($miEstado , 200);  
    return $newResponse;
  }

  public function BorrarUno($request, $response, $args) {  
    $estado = Estado::destroy($args['id']);
    $newResponse = $response->withJson($estado , 200);  
    return $newResponse;
  }
     
  public function ModificarUno($request, $response, $args) {
    $dato = json_decode(json_encode($request->getParsedBody()));

    $miEstado = Estado::find($args['id']);
    $miEstado->descripcion_estado = $dato->descripcion_estado;

    $miEstado->save();
    
    $newResponse = $response->withJson($miEstado, 200);  
    return 	$newResponse;
  }

}