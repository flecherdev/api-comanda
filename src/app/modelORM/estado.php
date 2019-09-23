<?php  
namespace App\Models\ORM;

class Estado extends \Illuminate\Database\Eloquent\Model {  
    public $timestamps = false;
    // Nombre de la tabla
    protected $table = 'estados';
    // Primary Key
    protected $primaryKey = 'id_estado';
}