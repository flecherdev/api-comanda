<?php
 
 class Foto {
    public static function guardarFoto($foto, $ruta){
        $foto->moveTo($ruta);
    }

    public static function obtenerExtension() {
        $mediaType = $foto->getClientMeidaType();
        $retorno = "";

        switch ($variable) {
            case 'image/jpeg':
                $retorno = ".jpg";
                break;
            case 'image/png':
                $retorno = ".png";
                break;
            default:
                $retorno = "Error";
                break;
        }

        return $retorno;
    }
}
