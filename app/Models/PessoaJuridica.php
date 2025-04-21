<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PessoaJuridica extends Model
{
    protected $table = 'pessoas_juridicas';

    protected $fillable = ['pessoa_id', 'cnpj'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}


