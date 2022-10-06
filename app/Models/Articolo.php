<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articolo extends Model
{
    use HasFactory;

    protected $table = 'articoli';

    const CREATED_AT = 'data_creazione';
    const UPDATED_AT = 'data_modifica';

    protected $fillable = [
        'id_materiale',
        'id_cliente',
        'codice',
        'descrizione',
        'peso_articolo',
        'lunghezza_tornito',
        'spessore_taglio',
        'sovrametallo',
        'lunghezza_barra',
        'lunghezza_spezzone',
        'recupero',
        'is_contolavoro'
    ];

    //Attributi al di fuori delle colonne del DB
    protected $appends = [
        'codice_completo',
        'lunghezza_tronchetto',
        'num_pezzi_barra',
        'lunghezza_scarto_pezzo_mozzicone',
        'lunghezza_tronchetto_totale'
    ];

    /**
     * Il codice dell'articolo completo = cliente.desinenza + articolo.codice
     */
    public function getCodiceCompletoAttribute()
    {
        return $this->cliente->desinenza . '-' . $this->codice;
    }

    /**
     * Lunghezza dell'articolo tornito
     */
    public function getLunghezzaTronchettoAttribute()
    {
        return round($this->lunghezza_tornito + $this->spessore_taglio + $this->sovrametallo,3);
    }

    /**
     * Numero di pezzi per barra
     */
    public function getNumPezziBarraAttribute()
    {
        return floor(($this->lunghezza_barra - $this->lunghezza_spezzone) / $this->lunghezza_tronchetto);
    }

    /**
     * Lunghezza scarto pezzo mozzicone
     */
    public function getLunghezzaScartoPezzoMozziconeAttribute()
    {
        return round($this->lunghezza_spezzone / $this->num_pezzi_barra,3);
    }

    /**
     * Lunghezza del tronchetto tottale
     */
    public function getLunghezzaTronchettoTotaleAttribute()
    {
        return round($this->lunghezza_tronchetto + $this->lunghezza_scarto_pezzo_mozzicone,3);
    }

    /**  Relazione N-1 */

    /**
     * Cliente dell'articolo
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'id_cliente');
    }

    /**
     * Materiale dell'articolo
     */
    public function materiale()
    {
        return $this->belongsTo(Materiale::class,'id_materiale');
    }

    /**  Relazione 1-N */

    /**
     * Altri costi
     */
    public function altri_costi()
    {
        return $this->hasMany(AltroCosto::class,'id_articolo');
    }

    /**
     * Lavorazioni esterne
     */
    public function lav_esterne()
    {
        return $this->hasMany(LavEsterna::class,'id_articolo');
    }

    /**
     * Lavorazioni interne
     */
    public function lav_interne()
    {
        return $this->hasMany(LavInterna::class,'id_articolo');
    }

    /**
     * Preventivi
     */
    public function preventivi()
    {
        return $this->hasMany(Preventivo::class,'id_articolo');
    }
}
