<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | medication_schedules
        |--------------------------------------------------------------------------
        */
        Schema::create('medication_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients');

            $table->time('time_of_day'); // Jam alarm
            $table->integer('duration_days')->default(7); // Durasi jadwal
            $table->date('start_date'); // Mulai minum obat

            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('version')->default(1);

            $table->tinyInteger('status')->default(0); // 0=ongoing, 1=completed

            $table->foreignId('cancelled_by')->nullable()->constrained('users');
            $table->text('cancellation_reason')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');

            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | medication_logs
        |--------------------------------------------------------------------------
        */
        Schema::create('medication_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('schedule_id')
                ->constrained('medication_schedules')
                ->onDelete('cascade');

            $table->date('log_date'); // tanggal konfirmasi diminum
            $table->boolean('is_taken')->default(false); // 0=belum, 1=sudah

            $table->string('img_path'); // path foto bukti
            $table->text('notes')->nullable();
            $table->timestamp('taken_at')->nullable();

            $table->foreignId('created_by')->constrained('patients'); // pasien yang konfirmasi

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medication_logs');
        Schema::dropIfExists('medication_schedules');
    }
};
