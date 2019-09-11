<?php
namespace App\Models\ORM;
use App\Models\ORM\cd;
use App\Models\IApiControler;

include_once __DIR__ . '/cd.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class cdControler implements IApiControler { 
    
  public function TraerTodos($request, $response, $args) { //OK
    $todosLosCds=cd::all();
    $newResponse = $response->withJson($todosLosCds, 200);  
    return $newResponse;
  }

  public function TraerUno($request, $response, $args) { // OK
    $traerUno = cd::find($args['id']);
    $newResponse = $response->withJson($traerUno, 200);  
    return $newResponse;
  }
   
  public function CargarUno($request, $response, $args) { // ok
    $dato = json_decode(json_encode($request->getParsedBody()));
    
    $miCd = new cd;
    $miCd->titel = $dato->titel;
    $miCd->interpret = $dato->interpret;
    $miCd->jahr = $dato->jahr;

    $miCd->save();

    $newResponse = $response->withJson($miCd , 200);  
    return $newResponse;
  }

  public function BorrarUno($request, $response, $args) { //ok
    $cd = cd::destroy($args['id']);
    $newResponse = $response->withJson($cd , 200);  
    return $newResponse;
  }
     
  public function ModificarUno($request, $response, $args) {
    $dato = json_decode(json_encode($request->getParsedBody()));

    $miCd = cd::find($args['id']);

    $miCd->titel = $dato->titel;
    $miCd->interpret = $dato->interpret;
    $miCd->jahr = $dato->jahr;

    $miCd->save();
    
    $newResponse = $response->withJson($miCd, 200);  
    return 	$newResponse;
  }  
}