<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alistamiento extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vehiculo_id', 'checklist', 'observaciones', 'foto_danio', 'estado'];

    protected $casts = [
        'checklist' => 'array',
    ];

    public function conductor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}