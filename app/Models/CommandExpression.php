<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CommandExpression extends Model
{
    use HasFactory;

    protected $table = 'commands_expression';
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'user_id',
        'cron_expression',
        'command_id'
    ];
    public $timestamps = false;

}
