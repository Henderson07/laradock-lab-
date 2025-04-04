<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Pessoa
{
    use HasFactory;

    protected $fillable = ['nome', 'cnpj'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pessoaJuridica) {
            $pessoaJuridica->cnpj = preg_replace('/[^0-9]/', '', $pessoaJuridica->cnpj); // Remove caracteres não numéricos
        });
    }
}
