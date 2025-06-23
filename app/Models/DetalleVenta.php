<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalleventas';
    public $timestamps = false;
    protected $fillable = [
        'precio',
        'cantidad',
    ];
    public function ventas()
    {
        return $this->hasOne(CabeceraVenta::class, 'idventa', 'idventa');
    }
    public function productos()
    {
        return $this->hasMany('App\Producto', 'idproducto', 'idproducto');
    }

}
