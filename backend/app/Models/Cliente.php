<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'empresa', 'codigo', 'razao_social', 'tipo', 'cpf_cnpj',
        // Adicione outros campos conforme necessário
    ];

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'recnum'; 
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa');
    }
}
