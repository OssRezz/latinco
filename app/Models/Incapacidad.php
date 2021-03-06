<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incapacidad extends Model
{
    protected $fillable = [
        'fkEmpleado',
        'fkTipo',
        'fechaInicio',
        'fechaFin',
        'totalDias',
        'diasEmpresa',
        'diasEps',
        'prorroga',
        'acumulado_prorroga',
        'numero_incapacidad',
        'quincenas_nomina',
        'observacion_id',
        'estado_id',
        'transcrita',
        'valor_pendiente',
    ];
    use HasFactory;
    protected $table = 'incapacidades';

    
    public function TipoIncapacidad()
    {
        return $this->belongsTo(TipoIncapacidad::class);
    }

    public function EstadoIncapacidad()
    {
        return $this->belongsTo(EstadoIncapacidad::class);
    }

    public function Empleado()
    {
        return $this->belongsTo('App\Models\Empleado');
    }
    
    public function Observacion()
    {
        return $this->belongsTo(Observacion::class);
    }
}
