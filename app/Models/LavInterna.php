<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LavInterna extends Model
{
    use HasFactory;

    protected $table = 'lav_interne';

    const CREATED_AT = 'data_creazione';
    const UPDATED_AT = 'data_modifica';

    protected $fillable = [
        'id_articolo',
        'id_macchinario',
        'descrizione',
        'costo_utensileria',
        'costo_setup',
        'costo_orario_macchina',
        'minuti_setup',
        'perc_resa',
        'tempo_pezzo'
    ];

    //Attributi al di fuori delle colonne del DB
    protected $appends = [
        'tempo_effettivo'
    ];

    /**
     * Tempo effettivo
     * precisione doppia
     */
    public function getTempoEffettivoAttribute()
    {
        return round($this->tempo_pezzo / 100 * (100 - $this->perc_resa) + $this->tempo_pezzo,2);
    }

    /**
     * Macchinario
     */
    public function macchinario()
    {
        return $this->belongsTo(Macchinario::class,'id_macchinario');
    }

    /**
     * Articolo
     */
    public function articolo()
    {
        return $this->belongsTo(Articolo::class,'id_articolo');
    }
}
