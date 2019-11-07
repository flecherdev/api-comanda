<?php
namespace App\Models\ORM;

class Fichada extends \Illuminate\Database\Eloquent\Model {  
    public $timestamps = false;
    // Nombre de la tabla
    protected $table = 'fichadas';
    // Primary Key
    protected $primaryKey = 'id_fichada';
}