<?php
namespace App\Models\ORM;
use App\Models\ORM\Mesa;
use App\Models\IApiControler;

include_once __DIR__ . '/mesa.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class MesaControler implements IApiControler {

    public function TraerTodos($request, $response, $args) {
        $todosLosTipos = Mesa::all();
        $newResponse = $response->withJson($todosLosTipos, 200);
        return $newResponse;
    }

    public function TraerUno($request, $response, $args) {
        $traerUno = Mesa::find($args['id']);
        $newResponse = $response->withJson($traerUno, 200);
        return $newResponse;
    }

    public function CargarUno($request, $response, $args) {
        $dato = json_decode(json_encode($request->getParsedBody()));

        $miMesa = new Mesa;
        $miMesa->descripcion_mesa = $dato->descripcion_mesa;
        $miMesa->foto = $dato->foto;

        $miMesa->save();

        $newResponse = $response->withJson($miMesa, 200);
        return $newResponse;
    }

    public function BorrarUno($request, $response, $args) {
        $mesa = Mesa::destroy($args['id']);
        $newResponse = $response->withJson($mesa, 200);
        return $newResponse;
    }

    public function ModificarUno($request, $response, $args) {
        $dato = json_decode(json_encode($request->getParsedBody()));

        $miMesa = Mesa::find($args['id']);
        $miMesa->descripcion_mesa= $dato->descripcion_mesa;
        $miMesa->foto = $dato->foto;

        $miMesa->save();

        $newResponse = $response->withJson($miMesa, 200);
        return $newResponse;
    }
}