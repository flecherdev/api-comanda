<?php
namespace App\Models;
use Firebase\JWT\JWT;

class Token {
    private static $claveSecreta = 'ClaveSuperSecreta@';
    private static $tipoEncriptacion = ['HS256'];
    private static $aud = null;
    
    public static function CodificarToken($usuario,$tipo,$id,$nombre_empleado) {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $ahora = time();

        $payload = array(
        	'iat'=>$ahora,
            'exp' => $ahora + (60),
            'aud' => self::Aud(),
            'usuario' => $usuario,
            'tipo' => $tipo,
            'id' => $id,
            'nombre' => $nombre_empleado,
            'app'=> "api rest comanda v1.0"
        );
        return JWT::encode($payload, self::$claveSecreta);
    }
    
    public static function DecodificarToken($token) {
        if(empty($token))
        {
            throw new Exception("El token esta vacio.");
        } 
        // las siguientes lineas lanzan una excepcion, de no ser correcto o de haberse terminado el tiempo       
      
        try {
            $decodificado = JWT::decode(
                $token,
                self::$claveSecreta,
                self::$tipoEncriptacion
            );
            $decoded = array("Estado" => "OK", "Mensaje" => "OK", "Payload" => $payload);
        }
        catch(\Firebase\JWT\BeforeValidException $e) {
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        catch(\Firebase\JWT\ExpiredException $e) {
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje.");
        }
        catch(\Firebase\JWT\SignatureInvalidException $e) {
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        catch(Exception $e) {
            $mensaje = $e->getMessage();
            $decoded = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } 
        return $decoded;
        // si no da error,  verifico los datos de AUD que uso para saber de que lugar viene  
        // if($decodificado->aud !== self::Aud())
        // {
        //     throw new Exception("No es el usuario valido");
        // }
    }
   
    // public static function ObtenerPayLoad($token) {
    //     return JWT::decode(
    //         $token,
    //         self::$claveSecreta,
    //         self::$tipoEncriptacion
    //     );
    // }
    
    // public static function ObtenerData($token) {
    //     return JWT::decode(
    //         $token,
    //         self::$claveSecreta,
    //         self::$tipoEncriptacion
    //     )->data;
    // }

    // private static function Aud() {
    //     $aud = '';
        
    //     if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    //         $aud = $_SERVER['HTTP_CLIENT_IP'];
    //     } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    //         $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
    //     } else {
    //         $aud = $_SERVER['REMOTE_ADDR'];
    //     }
        
    //     $aud .= @$_SERVER['HTTP_USER_AGENT'];
    //     $aud .= gethostname();
        
    //     return sha1($aud);
    // }

}