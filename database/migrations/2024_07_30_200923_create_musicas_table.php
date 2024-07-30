<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('musicas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('duracao');

            $table->unsignedBigInteger('id_album');
            $table->string('nome_album');
            $table->timestamps();

            // Define a chave estrangeira
            $table->foreign('id_album')
                ->references('id')
                ->on('discos')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('musicas');
    }
};
