<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;

    protected $table = 'message';
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'area_id',
        'query',
        'message',
        'pdf'
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
