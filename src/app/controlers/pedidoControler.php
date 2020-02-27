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
        //$fecha = $fechaPedido->format('Y-m-d');
        $id_empleado = $dato->id_empleado;
        $id_tipo = $dato->id_tipo; // que tipo de empleado soy
         
        if($id_tipo != 5) {
            $datosFecha = Pedido::select( // en eloquent el where funciona como un and
                'pedidos.id_pedidos',
                'pedidos.codigo_pedido',
                'pedidos.id_estado',
                'estados.descripcion_estado',
                'pedidos.fecha_pedido',
                'pedidos.hora_inicio_pedido',
                'pedidos.hora_estimada_entrega_pedido',
                'pedidos.hora_entrega_pedido',
                'pedidos.id_mesa',
                'pedidos.id_menu',
                'menus.nombre_menu',
                'pedidos.id_mozo',
                'pedidos.id_empleado',
                'pedidos.nombre_cliente',
                'pedidos.id_tipo_menu'
            )->whereDate(
                'pedidos.fecha_pedido', $fechaPedido //por fecha
            )->where(
                'pedidos.id_tipo_menu', $id_tipo // por tipo de empleado que refiere a que empleado se asigna
            )->join(
                'menus','menus.id_menu','=','pedidos.id_menu'
            )->join(
                'estados','estados.id_estado', '=', 'pedidos.id_estado'
            )->orderBy('pedidos.id_pedidos', 'DESC')->get();
        } else {
            $datosFecha = Pedido::select( // en eloquent el where funciona como un and
                'pedidos.id_pedidos',
                'pedidos.codigo_pedido',
                'pedidos.id_estado',
                'estados.descripcion_estado',
                'pedidos.fecha_pedido',
                'pedidos.hora_inicio_pedido',
                'pedidos.hora_estimada_entrega_pedido',
                'pedidos.hora_entrega_pedido',
                'pedidos.id_mesa',
                'pedidos.id_menu',
                'menus.nombre_menu',
                'menus.precio',
                'pedidos.id_mozo',
                'pedidos.id_empleado',
                'pedidos.nombre_cliente',
                'pedidos.id_tipo_menu'
            )->whereDate(
                'pedidos.fecha_pedido', $fechaPedido //por fecha
            )->join(
                'menus','menus.id_menu','=','pedidos.id_menu'
            )->join(
                'estados','estados.id_estado', '=', 'pedidos.id_estado'
            )->orderBy('pedidos.id_pedidos', 'DESC')->get();
        }

        
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
        $miPedido->fecha_pedido = $fechaPedido->format('Y-m-d');
        $miPedido->hora_inicio_pedido = $horaInicio->format('Y-m-d H:i:s');
        $miPedido->hora_estimada_entrega_pedido= $horaEstimada->format('Y-m-d H:i:s');
        // $miPedido->hora_entrega_pedido= date($dato->hora_entrega_pedido);
        $miPedido->id_mesa= $dato->id_mesa;
        $miPedido->id_menu= $dato->id_menu;
        $miPedido->id_mozo= $dato->id_mozo;
        $miPedido->id_empleado= $dato->id_empleado;
        $miPedido->nombre_cliente= $dato->nombre_cliente;
        $miPedido->id_tipo_menu= $dato->id_tipo_menu;
        
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
        //$miPedido->hora_entrega_pedido= $dato->hora_entrega_pedido;
        $miPedido->id_mesa= $dato->id_mesa;
        $miPedido->id_menu= $dato->id_menu;
        $miPedido->id_mozo= $dato->id_mozo;
        $miPedido->id_empleado= $dato->id_empleado;
        $miPedido->nombre_cliente= $dato->nombre_cliente;
        $miPedido->id_tipo_menu= $dato->id_tipo_menu;

        $miPedido->save();

        $newResponse = $response->withJson($miPedido, 200);
        return $newResponse;
    }

    
}