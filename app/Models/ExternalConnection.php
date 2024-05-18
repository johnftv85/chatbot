<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExternalConnection extends Model
{
    use HasFactory;

    protected $table = 'external_connection';
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'user_id',
        'name_database',
        'host',
        'user_name',
        'password',
        'cia',
        'state'
    ];
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
