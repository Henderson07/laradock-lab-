<?php

// tests/Unit/CadastroPessoaServiceTest.php
namespace Tests\Unit;

use Tests\TestCase;
use App\Services\CadastroPessoaService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CadastroPessoaServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_cadastro_de_pessoa_fisica()
    {
        $service = new CadastroPessoaService();

        $pessoa = $service->cadastrar([
            'nome' => 'João da Silva',
            'tipo' => 'F',
            'cpf' => '12345678901',
        ]);

        $this->assertDatabaseHas('pessoas', ['nome' => 'João da Silva']);
        $this->assertDatabaseHas('pessoa_fisicas', ['cpf' => '12345678901']);
    }
}
