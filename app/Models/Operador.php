<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operador extends Model
{
    /** @use HasFactory<\Database\Factories\OperadorFactory> */
    use HasFactory;
      protected $table = 'operadores';
    protected $primaryKey = 'idoperador';
    public $timestamps = false;
    protected $fillable = ['descripcion'];

}
