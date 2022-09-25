<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Macchinario extends Model
{
    use HasFactory;

    protected $table = 'macchinari';

    const CREATED_AT = 'data_creazione';
    const UPDATED_AT = 'data_modifica';

    protected $fillable = [
        'nome',
        'descrizione',
        'costo_orario_macchina',
        'costo_orario_setup'
    ];

    /**
     * Lavorazioni interne
     */
    public function lav_interne()
    {
        return $this->hasMany(LavInterna::class,'id_macchinario');
    }

}
