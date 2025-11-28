<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('questionnaire_questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('questionnaire_options', function (Blueprint $table) {
            $table->id();
            $table->string('option_text')->unique(); // opsi global
            $table->integer('weight');               // bobot harus integer
            $table->integer('sort_order')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaire_options');
        Schema::dropIfExists('questionnaire_questions');
    }
};
