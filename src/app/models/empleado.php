<?php  
namespace App\Models\ORM;

class empleado extends \Illuminate\Database\Eloquent\Model {  
    public $timestamps = false;
    // Nombre de la tabla
    protected $table = 'empleados';
    // Primary Key
    protected $primaryKey = 'id_empleado';
    // Filas de la tabla
    protected $fillable = [
        'nombre_empleado',
        'id_tipo',
        'clave_empleado',
        'estado_empleado',
        'created_at',
        'updated_at'
    ]; 

}