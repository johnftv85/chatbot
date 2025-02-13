<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionalOrder extends Model
{
    use HasFactory;

    protected $table = 'transactional_order';

    protected $fillable = [
        'status',
        'message',
        'ip',
        'user_id',
        'cellphone',
        'transaction_code',
        'attachment',
        'schedule',
        'wam_message_id',
        'latitude',
        'longitude',
        'location_name',
        'location_address',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'transaction_id');
    }
}
