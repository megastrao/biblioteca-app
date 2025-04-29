<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->nullable();
            $table->string('titulo');
            $table->foreignId('autor_id')->constrained('autores');
            $table->foreignId('editora_id')->constrained('editoras');
            $table->foreignId('genero_id')->constrained('generos');
            $table->integer('classificacao')->nullable();
            $table->string('edicao')->nullable();
            $table->integer('saldo')->nullable();
            $table->string('origin_user')->nullable();
            $table->string('last_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
