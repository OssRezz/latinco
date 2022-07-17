<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'cedula',
        'nombre',
        'fechaIngreso',
        'fechaRetiro',
        'estado',
        'salario',
        'eps',
        'fkCo',
        'fkCargo',
    ];
    use HasFactory;
    protected $table = 'empleados';

    public function Incapacidad()
    {
        return $this->hasMany(Incapacidad::class);
    }

    public function Co()
    {
        return $this->belongsTo(Co::class);
    }

}
