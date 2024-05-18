<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Command extends Model
{
    use HasFactory;

    protected $table = 'commands';
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'command'
    ];
    public $timestamps = false;

    public function ExternalConnection(): BelongsTo
    {
        return $this->belongsTo(ExternalConnection::class);
    }

}
