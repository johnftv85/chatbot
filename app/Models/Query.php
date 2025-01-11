<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    protected $table = 'queries';
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'name',
        'sentence',
        'from',
        'until'
    ];
    public $timestamps = false;
}
