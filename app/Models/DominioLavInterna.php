<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DominioLavInterna extends Model
{
    use HasFactory;

    protected $table = 'domini_lav_interne';

    public $timestamps = false;

    protected $fillable = [
        'descrizione'
    ];
}
