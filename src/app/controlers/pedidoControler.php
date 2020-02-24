<?php
namespace App\Models\ORM;
use App\Models\ORM\Pedido;
use App\Models\IApiControler;

include_once __DIR__ . '../../models/pedido.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class PedidoControler implements IApiControler {

    public function TraerTodos($request, $response, $args) {
        $todosLosPedidos = Pedido::all();
        $newResponse = $response->withJson($todosLosPedidos, 200);
        return $newResponse;
    }

    public function TraerFecha($request, $response, $args) {
        // traer los pedidos por fecha
        $dato = json_decode(json_encode($request->getParsedBody()));
        $fechaPedido = new \DateTime($dato->fecha_serch);
        $fecha = $fechaPedido->format('Y-m-d');
        $id_empleado = $dato->id_empleado;
        $id_tipo = $dato->id_tipo;
         
        $datosFecha = Pedido::select(
            'id_pedidos',
            'codigo_pedido',
            'id_estado',
            'fecha_pedido',
            'hora_inicio_pedido',
            'hora_estimada_entrega_pedido',
            'hora_entrega_pedido',
            'id_mesa',
            'id_menu',
            'id_mozo',
            'id_empleado',
            'nombre_cliente'
        )->where(
            'fecha_pedido', 'like', $fecha
        )->get();

        
        $newResponse = $response->withJson($datosFecha, 200);
        return $newResponse;
    }

    public function TraerUno($request, $response, $args) {
        $traerUno = Pedido::find($args['id']);
        $newResponse = $response->withJson($traerUno, 200);
        return $newResponse;
    }

    public function CargarUno($request, $response, $args) {
        $dato = json_decode(json_encode($request->getParsedBody()));

        $fechaPedido = new \DateTime($dato->fecha_pedido);
        $horaInicio = new \DateTime($dato->hora_inicio_pedido);
        $horaEstimada = new \DateTime($dato->hora_estimada_entrega_pedido);

        $miPedido = new Pedido;
        $miPedido->codigo_pedido= $dato->codigo_pedido;
        $miPedido->id_estado= $dato->id_estado;
        $miPedido->fecha_pedido = $fechaPedido->format('Y-m-d H:i:s');
        $miPedido->hora_inicio_pedido = $horaInicio->format('Y-m-d H:i:s');
        $miPedido->hora_estimada_entrega_pedido= $horaEstimada->format('Y-m-d H:i:s');
        // $miPedido->hora_entrega_pedido= date($dato->hora_entrega_pedido);
        $miPedido->id_mesa= $dato->id_mesa;
        $miPedido->id_menu= $dato->id_menu;
        $miPedido->id_mozo= $dato->id_mozo;
        $miPedido->id_empleado= $dato->id_empleado;
        $miPedido->nombre_cliente= $dato->nombre_cliente;
        
        $miPedido->save();

        $newResponse = $response->withJson($miPedido, 200);
        return $newResponse;
    }

    public function BorrarUno($request, $response, $args) {
        $mesa = Mesa::destroy($args['id']);
        $newResponse = $response->withJson($mesa, 200);
        return $newResponse;
    }

    public function ModificarUno($request, $response, $args) {
        $dato = json_decode(json_encode($request->getParsedBody()));

        $miPedido = Pedido::find($args['id']);
        $miPedido->codigo_pedido= $dato->codigo_pedido;
        $miPedido->id_estado= $dato->id_estado;
        $miPedido->fecha_pedido= $dato->fecha_pedido;
        $miPedido->hora_inicio_pedido= $dato->hora_inicio_pedido;
        $miPedido->hora_estimada_entrega_pedido= $dato->hora_estimada_entrega_pedido;
        $miPedido->hora_entrega_pedido= $dato->hora_entrega_pedido;
        $miPedido->id_mesa= $dato->id_mesa;
        $miPedido->id_menu= $dato->id_menu;
        $miPedido->id_mozo= $dato->id_mozo;
        $miPedido->id_empleado= $dato->id_empleado;
        $miPedido->id_nombre_cliente= $dato->id_nombre_cliente;

        $miPedido->save();

        $newResponse = $response->withJson($miPedido, 200);
        return $newResponse;
    }
}