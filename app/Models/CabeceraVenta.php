<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabeceraVenta extends Model
{
    protected $table = 'cabeceraventas';
    protected $primaryKey = 'idventa';
    public $timestamps = false;
    protected $fillable = [
        'idcliente',
        'idtipo',
        'fecha_venta',
        'nrodoc',
        'total',
        'estado'
    ];
    public function clientes()
    {
        return $this->hasOne(Cliente::class, 'idcliente', 'idcliente');
    }
    public function detalleventas()
    {
        return $this->hasMany('App\DetalleVenta', 'idventa', 'idventa');
    }
    public function tipo()
    {
        return $this->hasOne(Tipo::class, 'idtipo', 'idtipo');
    }

}
