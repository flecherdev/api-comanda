<?php
namespace App\Models\ORM;

class Tipo extends \Illuminate\Database\Eloquent\Model {
    public$timestamps = false;
    // NOmbre de la tabla
    protected $table = 'tipos';
    // Primary Key
    protected $primaryKey = 'id_tipo';
}