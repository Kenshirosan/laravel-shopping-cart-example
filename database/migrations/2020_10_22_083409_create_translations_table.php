<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->text('translation');
            $table->foreignId('language_id');

            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('language_translation', function (Blueprint $table) {
            $table->foreignId('translation_id');
            $table->foreignId('translatable_id');
            $table->string('translatable_type');
            $table->timestamps();

            $table->foreign('translation_id')->references('id')->on('translations')->onDelete('cascade');
            $table->primary(['translation_id', 'translatable_id', 'translatable_type'], 'language_translation_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
}
