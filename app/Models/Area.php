<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'name_area'
    ];
    public $timestamps = false;
}
