<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emoticon extends Model
{
    use HasFactory;

    protected $table = 'emoticons'; // Nombre de la tabla

    protected $fillable = ['code', 'description']; // Campos permitidos para inserción masiva

    /**
     * Mutador para almacenar el código URL-encoded.
     */
    public function setCodigoAttribute($value)
    {
        $this->attributes['code'] = urlencode($value);
    }

    /**
     * Accesor para decodificar el código al recuperarlo.
     */
    public function getCodigoAttribute($value)
    {
        return urldecode($value);
    }
}

