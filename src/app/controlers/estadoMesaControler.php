<?php
namespace App\Models\ORM;
use App\Models\ORM\EstadoMesa;
use App\Models\IApiControler;

include_once __DIR__ . '../../models/estadoMesa.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class EstadoMesaControler implements IApiControler { 

  public function TraerTodos($request, $response, $args) { 
    $todosLosEstadosMesa = EstadoMesa::all();
    $newResponse = $response->withJson($todosLosEstadosMesa, 200);  
    return $newResponse;
  }

  public function TraerUno($request, $response, $args) {
    $traerUno = EstadoMesa::find($args['id']);
    $newResponse = $response->withJson($traerUno, 200);  
    return $newResponse;
  }
   
  public function CargarUno($request, $response, $args) {  
    $dato = json_decode(json_encode($request->getParsedBody()));
    
    $miEstadoMesa = new EstadoMesa;
    $miEstadoMesa->descripcion_estado_mesa = $dato->descripcion_estado_mesa;

    $miEstadoMesa->save();

    $newResponse = $response->withJson($miEstadoMesa , 200);  
    return $newResponse;
  }

  public function BorrarUno($request, $response, $args) {  
    $estadoMesa = EstadoMesa::destroy($args['id']);
    $newResponse = $response->withJson($estadoMesa , 200);  
    return $newResponse;
  }
     
  public function ModificarUno($request, $response, $args) {
    $dato = json_decode(json_encode($request->getParsedBody()));

    $miEstadoMesa = EstadoMesa::find($args['id']);
    $miEstadoMesa->descripcion_estado_mesa = $dato->descripcion_estado_mesa;

    $miEstadoMesa->save();
    
    $newResponse = $response->withJson($miEstadoMesa, 200);  
    return 	$newResponse;
  }

}