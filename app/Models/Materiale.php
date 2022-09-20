<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiale extends Model
{
    use HasFactory;

    protected $table = 'materiali';

    const CREATED_AT = 'data_creazione';
    const UPDATED_AT = 'data_modifica';
}
