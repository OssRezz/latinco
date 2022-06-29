<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Co extends Model
{
    use HasFactory;
    protected $fillable = [
        'fkCompania', 'nombre', 'codigo'
    ];
    protected $table = 'co';

}
