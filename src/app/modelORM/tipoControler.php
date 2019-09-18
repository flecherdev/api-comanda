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
        $traerUno = Tipo::find($args['id']);
        $newResponse = $response->withJson($traerUno, 200);
        return $newResponse;
    }

    public function CargarUno($request, $response, $args) {
        $dato = json_decode(json_encode($request->getParsedBody()));

        $miTipo = new Tipo;
        $miTipo->descripcion_tipo = $dato->descripcion_tipo;

        $miTipo->save();

        $newResponse = $response->withJson($miTipo, 200);
        return $newResponse;
    }

    public function BorrarUno($request, $response, $args) {
        $tipo = Tipo::destroy($args['id']);
        $newResponse = $response->withJson($tipo, 200);
        return $newResponse;
    }

    public function ModificarUno($request, $response, $args) {
        $dato = json_decode(json_encode($request->getParsedBody()));

        $miTipo = Tipo::find($args['id']);
        $miTipo->descripcion_tipo = $dato->descripcion_tipo;

        $miTipo->save();

        $newResponse = $response->withJson($miTipo, 200);
        return $newResponse;
    }
}