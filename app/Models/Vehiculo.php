<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = ['placa', 'tipo', 'marca', 'modelo', 'user_id'];

    public function conductor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alistamientos()
{
    return $this->hasMany(Alistamiento::class);
}

}

