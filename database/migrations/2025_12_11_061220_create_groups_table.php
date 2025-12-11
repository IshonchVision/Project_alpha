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
        Schema::create('groups', function (Blueprint $table) {
           $table->id();
           $table->string('name');
            $table->string('code')->unique()->nullable(); // Guruh kodi (masalan: GR-2024-001)
            $table->text('description')->nullable();
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->string('subject')->nullable(); // Fan nomi
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->enum('status', ['active', 'inactive', 'completed', 'cancelled'])->default('active');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('lesson_time')->nullable(); // Dars vaqti (masalan: 09:00)
            $table->string('lesson_days')->nullable(); // Dars kunlari (masalan: Dushanba,Chorshanba,Juma)
            $table->integer('duration_months')->default(3); // Kurs davomiyligi (oylar)
            $table->integer('max_students')->default(20); // Maksimal talabalar soni
            $table->integer('current_students')->default(0); // Hozirgi talabalar soni
            $table->decimal('monthly_fee', 10, 2)->default(0); // Oylik to'lov
            $table->string('room')->nullable(); // Xona raqami
            $table->timestamps();
            $table->softDeletes(); // Soft delete
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
        
    }
};
