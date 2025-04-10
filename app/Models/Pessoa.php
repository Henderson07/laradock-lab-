<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = ['nome']; // Somente 'nome', pois cpf e cnpj serão nas subclasses

    public static function boot()
    {
        parent::boot();

        static::creating(function ($pessoa) {
            $pessoa->nome = ucfirst($pessoa->nome); // Capitaliza o nome antes de salvar
        });
    }
}

