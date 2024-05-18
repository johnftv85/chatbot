<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'tbl_log';
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'user_id',
        'tipodoc_id',
        'descripcion',
        'created_at',
        'update_at'
    ];

    public static function insertLog($dataBase, $idTipodoc, $description)
    {
        self::create([
            'user_id'=> $dataBase,
            'tipodoc_id'  => $idTipodoc,
            'descripcion' => $description,
            'created_at'  => now(),
            'update_at'   => now()
        ]);
    }
}
