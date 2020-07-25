<?php
namespace App\Models\ORM;
use App\Models\ORM\empleado;
use App\Models\IApiControler;
use App\Models\Token;

include_once __DIR__ . '../../models/empleado.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';
include_once __DIR__ . '../../modelAPI/Token.php';

class empleadoControler implements IApiControler {
    
  public function TraerTodos($request, $response, $args) { 
    $todosLosEmpleados=empleado::all();

    // uso de select con eloquent
    $data = empleado::select(
      'empleados.id_empleado',
      'empleados.nombre_empleado',
      'empleados.id_tipo',
      'empleados.estado_empleado',
      'empleados.foto_empleado',
      'empleados.created_at',
      'empleados.updated_at') 
    ->get();

    $newResponse = $response->withJson($data, 200);  
    return $newResponse;
  }

  public function TraerEmpleadosAdmin($request, $response, $args) {

    // uso de select con eloquent
    $data = empleado::select(
      'empleados.id_empleado',
      'empleados.nombre_empleado',
      'empleados.id_tipo',
      'tipos.descripcion_tipo',
      'empleados.estado_empleado',
      'empleados.foto_empleado',
      'empleados.created_at',
      'empleados.updated_at') 
    ->join(
      'tipos', 'tipos.id_tipo', '=', 'empleados.id_tipo'
    )->get();

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

    $fechaCreate = new \DateTime();
    
    $miEmpleado = new empleado;
    $miEmpleado->nombre_empleado = $dato->nombre_empleado;
    $miEmpleado->id_tipo = $dato->id_tipo;
    $miEmpleado->clave_empleado = $dato->clave_empleado;
    $miEmpleado->estado_empleado = $dato->estado_empleado;
    $miEmpleado->foto_empleado = $dato->foto_empleado;
    $miEmpleado->updated_at = $fechaCreate->format('Y-m-d H:i:s');
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
    // $miEmpleado->clave_empleado = $dato->clave_empleado;
    $miEmpleado->estado_empleado = $dato->estado_empleado;
    // $miEmpleado->created_at = $dato->created_at;
    // $miEmpleado->updated_at = $dato->updated_at;

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
      $respuesta = array("estado" => "error", "mensaje" => "usuario invalido.");
      $newResponse = $response->withJson($respuesta,200);
      return $newResponse;
    }

    // Empleado inactivo no puede loguearse
    if($miEmpleado->estado_empleado === 0){
      $respuesta = array("estado" => "error", "mensaje" => "usuario inactivo.");
      $newResponse = $response->withJson($respuesta,200);
      return $newResponse;
    }

    // creo una instancia de un empleado y saco la clave para enviarla con el token
    $empleado = new empleado;
    $empleado->id_empleado = $miEmpleado->id_empleado;
    $empleado->nombre_empleado = $miEmpleado->nombre_empleado;
    $empleado->id_tipo = $miEmpleado->id_tipo;
    $empleado->estado_empleado = $miEmpleado->estado_empleado;
    // $empleado->created_at = $miEmpleado->created_at;
    // $empleado->updated_at = $miEmpleado->updated_at;


    // GENERAR TOKEN CON empleado
    if ($empleado) {
      $token = Token::CodificarToken($empleado);
      
      // ACTUALIZAR FECHA DE LOGIN
      $fechaLogin = new \DateTime();
      $miEmpleado->updated_at = $fechaLogin->format('Y-m-d H:i:s');
      $miEmpleado->save();

      $respuesta = array("estado" => "ok", "mensaje" => "logueado exitosamente.", "token" => $token);
    } else {
        $respuesta = array("estado" => "error", "mensaje" => "u suario o clave invalidos.");
    }
    
    $newResponse = $response->withJson($respuesta, 200);
    return $newResponse;
  }

}