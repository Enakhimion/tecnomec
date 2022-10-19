<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorie';

    protected $fillable = [
        'descrizione'
    ];

    /**
     * Articoli
     */
    public function articoli()
    {
        return $this->hasMany(Articolo::class,'id_categoria');
    }
}
