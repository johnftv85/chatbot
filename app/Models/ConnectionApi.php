<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectionApi extends Model
{
    use HasFactory;

    protected $table = 'connections_api';
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'url',
        'endpoint',
        'body',
        'headers',
        'method',
        'params',
        'state',
        'message'
    ];

    public $timestamps = false;
}
