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
        // Como melhorias, para melhorar a legibilidade do código, foi adicionado o método foreignId() e o método constrained() para simplificar a criação da chave estrangeira e a troca da ordem dos campos de timestamp para o final da tabela
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // foreignId() e constrained() simplificam o código
            $table->string('title', 60);
            $table->text('contents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
