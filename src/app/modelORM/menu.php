<?php
namespace App\Models\ORM;

class Menu extends \Illuminate\Database\Eloquent\Model {  
    public $timestamps = false;
    // Nombre de la tabla
    protected $table = 'menu';
    // Primary Key
    protected $primaryKey = 'id_menu';
}