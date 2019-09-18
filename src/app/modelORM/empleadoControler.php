<?php
namespace App\Models\ORM;
use App\Models\ORM\empleado;
use App\Models\IApiControler;

include_once __DIR__ . '/empleado.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class empleadoControler implements IApiControler {
    
  public function TraerTodos($request, $response, $args) { //OK
    $todosLosEmpleados=empleado::all();
    $newResponse = $response->withJson($todosLosEmpleados, 200);  
    return $newResponse;
  }

  public function TraerUno($request, $response, $args) { // OK
    $traerUno = empleado::find($args['id']);
    $newResponse = $response->withJson($traerUno, 200);  
    return $newResponse;
  }
   
  public function CargarUno($request, $response, $args) { 
    $dato = json_decode(json_encode($request->getParsedBody()));
    
    $miEmpleado = new empleado;
    $miEmpleado->nombre_empleado = $dato->nombre_empleado;
    $miEmpleado->id_tipo = $dato->id_tipo ;
    $miEmpleado->clave_empleado = $dato->clave_empleado;
  //  $miEmpleado->estado_empleado = $dato->estado_empleado;
    $miEmpleado->created_at = $dato->created_at;
    $miEmpleado->updated_at = $dato->updated_at;

    $miEmpleado->save();

    $newResponse = $response->withJson($miEmpleado , 200);  
    return $newResponse;
  }

  public function BorrarUno($request, $response, $args) { //ok
    $empleado = empleado::destroy($args['id']);
    $newResponse = $response->withJson($empleado , 200);  
    return $newResponse;
  }
     
  public function ModificarUno($request, $response, $args) {
    $dato = json_decode(json_encode($request->getParsedBody()));

    $miEmpleado = empleado::find($args['id']);

    $miEmpleado->nombre_empleado = $dato->nombre_empleado;
    $miEmpleado->id_tipo = $dato->id_tipo ;
    $miEmpleado->clave_empleado = $dato->clave_empleado;
    $miEmpleado->created_at = $dato->created_at;
    $miEmpleado->updated_at = $dato->updated_at;

    $miEmpleado->save();
    
    $newResponse = $response->withJson($miEmpleado, 200);  
    return 	$newResponse;
  }

}