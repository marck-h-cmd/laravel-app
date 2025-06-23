<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos';
 protected $primaryKey = 'idtipo';
 public $timestamps = false;
 protected $fillable = [
 'descripcion',
 ];
 public function ventas()
 {
 return $this->hasMany('App\CabeceraVenta','idtipo','idtipo');
 }

}
