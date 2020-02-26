<?php
namespace App\Models\ORM;
use App\Models\ORM\Menu;
use App\Models\IApiControler;

include_once __DIR__ . '../../models/menu.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';

class MenuControler implements IApiControler {

    public function TraerTodos($request, $response, $args) {
        $todosLosTipos = Menu::all();
        $newResponse = $response->withJson($todosLosTipos, 200);
        return $newResponse;
    }

    public function TraerUno($request, $response, $args) {
        $traerUno = Menu::find($args['id']);
        $newResponse = $response->withJson($traerUno, 200);
        return $newResponse;
    }

    public function CargarUno($request, $response, $args) {
        $dato = json_decode(json_encode($request->getParsedBody()));

        $miMenu = new Menu;
        $miMenu->nombre_menu = $dato->nombre_menu;
        $miMenu->precio_menu = $dato->precio_menu;
        $miMenu->id_tipo = $dato->id_tipo ;
        $miMenu->descripcion_menu = $dato->descripcion_menu;
        $miMenu->foto_menu = $dato->foto_menu;

        $miMenu->save();

        $newResponse = $response->withJson($miMenu, 200);
        return $newResponse;
    }

    public function BorrarUno($request, $response, $args) {
        $menu = Menu::destroy($args['id']);
        $newResponse = $response->withJson($menu, 200);
        return $newResponse;
    }

    public function ModificarUno($request, $response, $args) {
        $dato = json_decode(json_encode($request->getParsedBody()));

        $miMenu = Menu::find($args['id']);
        $miMenu->nombre_menu = $dato->nombre_menu;
        $miMenu->precio = $dato->precio_menu;
        $miMenu->id_tipo = $dato->id_tipo ;
        $miMenu->descripcion_menu = $dato->descripcion_menu;
        $miMenu->foto_menu = $dato->foto_menu;


        $miMenu->save();

        $newResponse = $response->withJson($miMenu, 200);
        return $newResponse;
    }
}