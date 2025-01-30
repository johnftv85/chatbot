<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

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
    }
}
