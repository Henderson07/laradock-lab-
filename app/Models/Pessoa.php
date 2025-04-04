<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($pessoa) {
            $pessoa->nome = ucfirst($pessoa->nome); // Capitaliza o nome antes de salvar
        });
    }
}
