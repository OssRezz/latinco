<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Co extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'codigo',
        'compania_id',
    ];
    protected $table = 'co';

    public function compania()
    {
        return $this->belongsTo(Compania::class, 'compania_id');
    }

    public function Empleado()
    {
        return $this->hasMany(Empleado::class);
    }
}
