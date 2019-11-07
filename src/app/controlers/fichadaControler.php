<?php
namespace App\Models\ORM;
use App\Models\ORM\Fichada;
use App\Models\IApiControler;

include_once __DIR__ . '../../models/fichada.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class FichadaControler implements IApiControler {
    
  public function TraerTodos($request, $response, $args) { 
    $todosLasFichadas = Fichada::all();
    $newResponse = $response->withJson($todosLasFichadas, 200);  
    return $newResponse;
  }

  public function TraerUno($request, $response, $args) {
    $traerUno = Fichada::find($args['id']);
    $newResponse = $response->withJson($traerUno, 200);  
    return $newResponse;
  }
   
  public function CargarUno($request, $response, $args) {  
    $dato = json_decode(json_encode($request->getParsedBody()));
    
    $miFichada = new Fichada;
    $miFichada->id_empleado = $dato->id_empleado;
    $miFichada->ingreso_fichada = $dato->ingreso_fichada;
    $miFichada->salida_fichada = $dato->salida_fichada;

    $miFichada->save();

    $newResponse = $response->withJson($miFichada , 200);  
    return $newResponse;
  }

  public function BorrarUno($request, $response, $args) {  
    $estadoMesa = Fichada::destroy($args['id']);
    $newResponse = $response->withJson($estadoMesa , 200);  
    return $newResponse;
  }
     
  public function ModificarUno($request, $response, $args) {
    $dato = json_decode(json_encode($request->getParsedBody()));

    $miFichada = Fichada::find($args['id']);
    $miFichada->id_empleado = $dato->id_empleado;
    $miFichada->ingreso_fichada = $dato->ingreso_fichada;
    $miFichada->salida_fichada = $dato->salida_fichada;

    $miFichada->save();
    
    $newResponse = $response->withJson($miFichada, 200);  
    return 	$newResponse;
  }

}