<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipologiaLavEsterna extends Model
{
    use HasFactory;

    protected $table = 'tipologie_lav_esterne';

    public $timestamps = false;

    protected $fillable = [
        'descrizione'
    ];

    /**
     * Lavorazioni esterne
     */
    public function lav_esterne()
    {
        return $this->hasMany(LavEsterna::class,'id_tipologia');
    }
}
