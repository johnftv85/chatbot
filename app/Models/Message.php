<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
=======
>>>>>>> bexchatbot/master

class Message extends Model
{
    use HasFactory;

<<<<<<< HEAD
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
=======
    protected $table = 'messages';

    protected $fillable = [
        'wa_id',
        'wam_id',
        'transaction_id',
        'type',
        'outgoing',
        'body',
        'status',
        'caption',
        'data'
    ];

    public function transactionalOrder()
    {
        return $this->belongsTo(TransactionalOrder::class, 'transaction_id');
>>>>>>> bexchatbot/master
    }
}
