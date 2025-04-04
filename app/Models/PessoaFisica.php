<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Pessoa
{
    use HasFactory;

    protected $fillable = ['nome', 'cpf'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pessoaFisica) {
            $pessoaFisica->cpf = preg_replace('/[^0-9]/', '', $pessoaFisica->cpf); // Remove caracteres não numéricos
        });
    }
}
