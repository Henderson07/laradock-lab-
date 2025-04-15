<?php

// app/Models/Pessoa.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function pessoaFisica()
    {
        return $this->hasOne(PessoaFisica::class);
    }

    public function pessoaJuridica()
    {
        return $this->hasOne(PessoaJuridica::class);
    }
}


