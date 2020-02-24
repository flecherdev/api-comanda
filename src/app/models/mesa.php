<?php
namespace App\Models\ORM;

class Mesa extends \Illuminate\Database\Eloquent\Model {  
    public $timestamps = false;
    // Nombre de la tabla
    protected $table = 'mesas';
    // Primary Key
    protected $primaryKey = 'id_mesa';
}