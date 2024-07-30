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
        Schema::create('musicas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('duracao');

            $table->unsignedBigInteger('id_album'); // Coluna para referenciar a tabela discos
            $table->timestamps();

            // Define a chave estrangeira
            $table->foreign('id_album')
                ->references('id')
                ->on('discos')
                ->onDelete('cascade');  // Adiciona comportamento em caso de exclusão do disco
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musicas');
    }
};
