<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('imported_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->comment('Nome unico do arquivo importado');
            $table->string('path')->comment('Diretorio do arquivo');
            $table->string('disk')->comment('Unidade de armazenamento, seja local, publico, s3');
            $table->enum('status', ['pending','processing', 'success', 'error'])->default('pending');
            $table->unsignedInteger('imported_lines')->nullable()->comment('Número total de linhas processadas e importadas com sucesso do arquivo JSON.');
            $table->unsignedInteger('lines_errors')->nullable()->comment('Número total de linhas processadas e importadas com sucesso do arquivo JSON.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imported_files');
    }
};
