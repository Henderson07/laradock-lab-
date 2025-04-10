<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

class PessoaFisica extends Pessoa
{
    protected $fillable = ['cpf_cnpj']; // Apenas CPF aqui
    protected $table = 'pessoas'; // Garante que usa a única tabela

    public static function boot()
    {
        parent::boot();

        static::creating(function ($pessoa) {
            $pessoa->tipo = 'F'; // Define que é pessoa física
        });
    }
}

