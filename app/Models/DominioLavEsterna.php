<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DominioLavEsterna extends Model
{
    use HasFactory;

    protected $table = 'domini_lav_esterne';

    public $timestamps = false;

    protected $fillable = [
        'descrizione'
    ];

}
