<?php

namespace App\Models;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $table = 'parametros';
    protected $primaryKey = 'tipo_id';
    public $timestamps = false;
    protected $fillable = [
        'numeracion',
        'serie',
    ];
    public static function ActualizarNumero($tipo_id, $numeracion)
    {
        try {
            DB::table('parametros')->where('idtipo', '=', $tipo_id)->update([
                'numeracion' => $numeracion
            ]);
            return true;
        } catch (Exception $ex) {

        }
    }
}

