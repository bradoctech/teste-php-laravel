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
        Schema::create('documents', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('id_categories')->unsigned();
            $table->foreign('id_categories')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title', 60);
            $table->text('contents');
            $table->boolean('activate');
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
