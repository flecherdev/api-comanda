<?php
namespace App\Models\ORM;

class EstadoMesa extends \Illuminate\Database\Eloquent\Model {  
    public $timestamps = false;
    // Nombre de la tabla
    protected $table = 'estado_mesa';
    // Primary Key
    protected $primaryKey = 'id_estado_mesa';
}