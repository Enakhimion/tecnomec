<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AltroCosto extends Model
{
    use HasFactory;

    protected $table = 'altri_costi';

    const CREATED_AT = 'data_creazione';
    const UPDATED_AT = 'data_modifica';

    protected $fillable = [
        'id_articolo',
        'descrizione',
        'importo'
    ];

    /**
     * Articolo del costo
     */
    public function articolo()
    {
        return $this->belongsTo(Articolo::class,'id_articolo');
    }
}
