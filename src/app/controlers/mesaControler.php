<?php
namespace App\Models\ORM;
use App\Models\ORM\Mesa;
use App\Models\IApiControler;

include_once __DIR__ . '../../models/mesa.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class MesaControler implements IApiControler {

    public function TraerTodos($request, $response, $args) {
        $todosLosTipos = Mesa::all();

        // inner join entre mesa y estado_mesa
        $data = Mesa::select('mesas.id_mesa','mesas.codigo_mesa','estado_mesa.descripcion_estado_mesa','mesas.foto_mesa')
                            ->join('estado_mesa','mesas.id_estado_mesa', '=', 'estado_mesa.id_estado_mesa')
                            ->get();

        $newResponse = $response->withJson($data, 200);
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
        $miMesa->descripcion_mesa= $dato->descripcion_mesa;
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