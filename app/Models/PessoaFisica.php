<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PessoaFisica extends Model
{
    protected $table = 'pessoas_fisicas';

    protected $fillable = ['pessoa_id', 'cpf'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}

