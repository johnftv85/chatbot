<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExternalMessage extends Model
{
    use HasFactory;

    protected $table = 'external_message';
    protected $connection = 'mysql';
    protected $fillable = [
        'user_id',
        'message_id'
    ];
    public $timestamps = false;

    // public function user(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class);
    // }

    // public function message(): HasMany
    // {
    //     return $this->hasMany(Message::class);
    // }
}
