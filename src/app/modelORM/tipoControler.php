<?php
namespace App\Models\ORM;
use App\Models\ORM\Tipo;
use App\Models\IApiControler;

include_once __DIR__ . '/tipo.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class TipoControler implements IApiControler {

    public function TraerTodos($request, $response, $args) {
        $todosLosTipos = Tipo::all();
        $newResponse = $response->withJson($todosLosTipos, 200);
        return $newResponse;
    }

    public function TraerUno($request, $response, $args) {
        $traerUno = Tpo::find($args['id']);
        $newResponse = $response->with($traerUno, 200);
        return $newResponse;
    }

    public function CargarUno($request, $response, $args) {
        $dato = json_decode(json_encode($request->getParseBody()));

        $miTipo = new Tipo;
        $miTipo->descripcion_estado = $dato->descripcion_tipo;

        $miTipo->save();
        
        $newResponse = $response->withJson($miTipo, 200);
        return $newResponse;
    }

    public function BorrarUno($request, $response, $args) {
        
    }

    public function ModificarUno($request, $response, $args) {
        
    }
}