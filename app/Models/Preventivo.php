<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preventivo extends Model
{
    use HasFactory;

    protected $table = 'preventivi';

    const CREATED_AT = 'data_creazione';
    const UPDATED_AT = 'data_modifica';

    protected $fillable = [
        'id_articolo',
        'data',
        'ricarico_materiale',
        'ricarico_interne',
        'ricarico_esterne',
        'ricarico_altro',
        'qta1',
        'qta2',
        'qta3',
        'qta4',
        'prezzo1',
        'prezzo2',
        'prezzo3',
        'prezzo4',
    ];

    /**
     * Articolo del preventivo
     */
    public function articolo()
    {
        return $this->belongsTo(Articolo::class,'id_articolo');
    }
}
