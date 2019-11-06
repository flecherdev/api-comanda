<?php
namespace App\Models\ORM;

class Menu extends \Illuminate\Database\Eloquent\Model {  
    public $timestamps = false;
    // Nombre de la tabla
    protected $table = 'menus';
    // Primary Key
    protected $primaryKey = 'id_menu';
}