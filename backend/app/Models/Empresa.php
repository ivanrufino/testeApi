<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'codigo','empresa','sigla','razao_social'
    ];

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'recnum'; 
    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'empresa');
    }
}
