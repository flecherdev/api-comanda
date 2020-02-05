<?php
namespace App\Models\ORM;
use App\Models\ORM\empleado;
use App\Models\IApiControler;

include_once __DIR__ . '../../models/empleado.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class empleadoControler implements IApiControler {
    
  public function TraerTodos($request, $response, $args) { 
    $todosLosEmpleados=empleado::all();

    // uso de select con eloquent
    $data = empleado::select(
      'empleados.id_empleado',
      'empleados.nombre_empleado',
      'empleados.id_tipo',
      'empleados.estado_empleado',
      'empleados.created_at',
      'empleados.updated_at') 
    ->get();

    $newResponse = $response->withJson($data, 200);  
    return $newResponse;
  }

  public function TraerUno($request, $response, $args) {
    $traerUno = empleado::find($args['id']);
    $newResponse = $response->withJson($traerUno, 200);  
    return $newResponse;
  }
   
  public function CargarUno($request, $response, $args) {  
    $dato = json_decode(json_encode($request->getParsedBody()));
    
    $miEmpleado = new empleado;
    $miEmpleado->nombre_empleado = $dato->nombre_empleado;
    $miEmpleado->id_tipo = $dato->id_tipo;
    $miEmpleado->clave_empleado = $dato->clave_empleado;
    $miEmpleado->estado_empleado = $dato->estado_empleado;
    $miEmpleado->created_at = $dato->created_at;
    $miEmpleado->updated_at = $dato->updated_at;

    $miEmpleado->save();

    $newResponse = $response->withJson($miEmpleado , 200);
    return $newResponse;
  }

  public function BorrarUno($request, $response, $args) {  
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
    $miEmpleado->estado_empleado = $dato->estado_empleado;
    $miEmpleado->created_at = $dato->created_at;
    $miEmpleado->updated_at = $dato->updated_at;

    $miEmpleado->save();
    
    $newResponse = $response->withJson($miEmpleado, 200);  
    return 	$newResponse;
  }

  // post login usuario y contraseña
  public function LoginNombrePass($request, $response, $args) {  
    $dato = json_decode(json_encode($request->getParsedBody()));

    $nombre = $dato->nombre_empleado;
    $password = $dato->clave_empleado;

    // me trae la data si nombre y pass coiciden en eloquent el where anidado se toma como AND
    $miEmpleado = empleado::where('nombre_empleado', $nombre)
                            ->where('clave_empleado', $password)
                            ->get()->first();

    //var_dump($miEmpleado);
    if(!isset($miEmpleado)){
      $respuesta = array("Estado" => "ERROR", "Mensaje" => "Usuario invalido.");
      $newResponse = $response->withJson($respuesta,200);
      return $newResponse;
    }
    
    return $response->withJson($miEmpleado , 200);
    
  }

}