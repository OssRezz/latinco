<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'observacion',
    ];
    protected $table = 'observaciones';

    public function Incapacidad()
    {
        return $this->hasMany(Incapacidad::class);
    }
}
