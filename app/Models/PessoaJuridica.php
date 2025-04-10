<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Pessoa
{
    protected $fillable = ['cpf_cnpj']; // Apenas CNPJ aqui
    protected $table = 'pessoas'; // Garante que usa a única tabela


    public static function boot()
    {
        parent::boot();

        static::creating(function ($pessoa) {
            $pessoa->tipo = 'J'; // Define que é pessoa jurídica
        });
    }
}


