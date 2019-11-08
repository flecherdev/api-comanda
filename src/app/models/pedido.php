<?php
namespace App\Models\ORM;

class Pedido extends \Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    // NOmbre de la tabla
    protected $table = 'pedidos';
    // Primary Key
    protected $primaryKey = 'id_pedidos';
}