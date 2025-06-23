<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    /** @use HasFactory<\Database\Factories\UnidadFactory> */
    use HasFactory;
     protected $table = 'unidades';
    protected $primaryKey = 'idunidad';
    public $timestamps = false;
    protected $fillable = ['descripcion', 'estado'];
}
