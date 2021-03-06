<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIncapacidad extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo',
    ];
    protected $table = 'tipo_incapacidades';

    public function Incapacidad()
    {
        return $this->hasMany(Incapacidad::class);
    }
}
