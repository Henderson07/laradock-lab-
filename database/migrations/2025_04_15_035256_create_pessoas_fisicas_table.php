<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasFisicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas_fisicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->constrained('pessoas')->onDelete('cascade');
            $table->string('cpf', 11)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pessoas_fisicas');
    }
}
