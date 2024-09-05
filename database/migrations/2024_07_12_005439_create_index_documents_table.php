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
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->unique('title');
            $table->fullText('contents');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropUnique('documents_title_unique');
            $table->dropFullText('documents_contents_fulltext');
        });
    }
};
