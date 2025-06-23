<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Unidad;
class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;
    protected $table = 'productos';
    protected $primaryKey = 'idproducto';
    public $timestamps = false;
    protected $fillable = ['descripcion', 'idcategoria', 'estado', 'idunidad', 'stock', 'precio'];

    public function categoria()
    {
        return $this->hasOne(Categoria::class, 'idcategoria', 'idcategoria');
    }
    public function unidad()
    {
        return $this->hasOne(Unidad::class, 'idunidad', 'idunidad');
    }
}
