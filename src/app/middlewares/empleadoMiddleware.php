<?php
namespace App\Models\ORM;
use App\Models\Token;

include_once __DIR__ . '../../modelAPI/Token.php';

class EmpleadoMiddleware {
    ///Valida el token.
    public static function ValidarToken($request,$response,$next){
        $token = $request->getHeader("Authorization");
        // var_dump($token);
        $validacionToken = Token::DecodificarToken($token[0]);
        // var_dump($validacionToken);
        if($validacionToken["estado"] == "ok"){
            $request = $request->withAttribute("payload", $validacionToken);
            return $next($request,$response);
        }
        else{
            $newResponse = $response->withJson($validacionToken,200);
            return $newResponse;
        }
    }

    /// Sólo puede acceder un empleado de tipo socio a esta característica.
    public static function ValidarSocio($request,$response,$next){
        $payload = $request->getAttribute("payload")["Payload"];
        $tipoEmployee = $payload->tipo;
        if($tipoEmployee == 5){ // 5- socio
            return $next($request,$response);
        }
        else{
            $respuesta = array("estado" => "error", "mensaje" => "No tienes permiso para realizar esta accion (Solo categoria socio).");
            $newResponse = $response->withJson($respuesta,200);
            return $newResponse;
        }
    }

    /// Sólo puede acceder un empleado de tipo mozo o socio a esta característica.
    public static function ValidarMozo($request,$response,$next){
        $payload = $request->getAttribute("payload")["Payload"];
        $tipoEmployee = $payload->tipo;
        if($tipoEmployee == 4 || $tipoEmployee == 5){ // 4-mozo y 5- socio
            return $next($request,$response);
        }
        else{
            $respuesta = array("estado" => "error", "mensaje" => "No tienes permiso para realizar esta accion (Solo categoria mozo).");
            $newResponse = $response->withJson($respuesta,200);
            return $newResponse;
        }
    }
}