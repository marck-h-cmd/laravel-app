<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'idcliente';
    public $timestamps = false;
    protected $fillable = ['nomcliente', 'ruc_dni','apecliente', 'estado', 'dircliente', 'idoperador', 'telefono', 'ruc_dni'];

    public function operador()
    {
        return $this->hasOne(Operador::class, 'idoperador', 'idoperador');
    }

    public function ventas()
    {
        return $this->hasMany('App\CabeceraVenta', 'idcliente', 'idcliente');

    }

}
