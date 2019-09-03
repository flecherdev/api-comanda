<?php
namespace App\Models\ORM;
use App\Models\ORM\cd;
use App\Models\IApiControler;

include_once __DIR__ . '/cd.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class cdControler implements IApiControler {

 	public function Beinvenida($request, $response, $args) {
    $response->getBody()->write("GET => Bienvenido!!! ,a UTN FRA SlimFramework");
    return $response;
  }
    
  public function TraerTodos($request, $response, $args) {
    $todosLosCds=cd::all();
    $newResponse = $response->withJson($todosLosCds, 200);  
    return $newResponse;
  }

  public function TraerUno($request, $response, $args) {
    $traerUno = cd::find($args['id']);
    $newResponse = $response->withJson($traerUno, 200);  
    return $newResponse;
  }
   
  public function CargarUno($request, $response, $args) {
    $dato = $request->getParsedBody();
    $cd = cd::create(['cd' => $dato['cd']]);
    $newResponse = $response->withJson($cd , 200);  
    return $newResponse;
  }

  public function BorrarUno($request, $response, $args) {
    //complete el codigo
    $newResponse = $response->withJson("algo" , 200);  
    return $newResponse;
  }
     
  public function ModificarUno($request, $response, $args) {
    //complete el codigo
    $newResponse = $response->withJson("sin completar", 200);  
    return 	$newResponse;
  }  
}