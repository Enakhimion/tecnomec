<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LavEsterna extends Model
{
    use HasFactory;

    protected $table = 'lav_esterne';

    const CREATED_AT = 'data_creazione';
    const UPDATED_AT = 'data_modifica';

    protected $fillable = [
        'id_articolo',
        'id_tipologia',
        'descrizione',
        'importo',
        'stato'
    ];

    /**
     * Tipologia della lavorazione
     */
    public function cliente()
    {
        return $this->belongsTo(TipologiaLavEsterna::class,'id_tipologia');
    }

    /**
     * Articolo della lavorazione
     */
    public function articolo()
    {
        return $this->belongsTo(Articolo::class,'id_articolo');
    }
}
