<?php
namespace App\Models\ORM;
use App\Models\ORM\empleado;
use App\Models\IApiControler;

include_once __DIR__ . '/empleado.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class empleadoControler implements IApiControler {
    
  public function TraerTodos($request, $response, $args) {
    //return cd::all()->toJson();
    $todosLosCds=empleado::all();
    $newResponse = $response->withJson($todosLosCds, 200);  
    return $newResponse;
  }

  public function TraerUno($request, $response, $args) {
    //complete el codigo
    $traerUno = empleado::find($args['id']);
    $newResponse = $response->withJson($traerUno, 200);  
    return $newResponse;
  }
   
  public function CargarUno($request, $response, $args) {
    //complete el codigo
    $newResponse = $response->withJson("sin completar", 200);  
    return $response;
  }

  public function BorrarUno($request, $response, $args) {
    //complete el codigo
    $newResponse = $response->withJson("sin completar", 200);  
    return $newResponse;
  }
     
  public function ModificarUno($request, $response, $args) {
    //complete el codigo
    $newResponse = $response->withJson("sin completar", 200);  
    return 	$newResponse;
  }  
}