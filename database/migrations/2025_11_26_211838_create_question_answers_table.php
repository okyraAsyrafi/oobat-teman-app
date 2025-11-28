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
        // HEADER JAWABAN (1 kali isi kuisioner)
        Schema::create('question_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients');
            $table->timestamp('date_answer'); // tanggal pasien mengisi
            $table->decimal('score_avg', 15, 2)->default(0); // rata-rata nilai
            $table->text('side_effect')->nullable(); // efek samping
            $table->text('complaints')->nullable(); // keluhan
            $table->foreignId('created_by')->constrained('patients');
            $table->foreignId('updated_by')->nullable()->constrained('patients');
            $table->timestamps();
        });

        // DETAIL PER PERTANYAAN
        Schema::create('question_detail_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_answer_id')->constrained('question_answers')->cascadeOnDelete();
            $table->foreignId('questionnaire_question_id')->constrained('questionnaire_questions');
            $table->foreignId('questionnaire_option_id')->constrained('questionnaire_options');
            $table->foreignId('created_by')->constrained('patients');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_detail_answers');
        Schema::dropIfExists('question_answers');
    }
};
