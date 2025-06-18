<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'tipo',
        'marca',
        'linea',
        'modelo',
        'user_id',
        'soat_pdf',
        'tecnico_mecanica_pdf',
        'licencia_transito_pdf',
        'soat_expedicion',
        'soat_vencimiento',
        'tecnico_mecanica_expedicion',
        'tecnico_mecanica_vencimiento',
    ];

    public function conductor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alistamientos()
{
    return $this->hasMany(Alistamiento::class);
}

}

