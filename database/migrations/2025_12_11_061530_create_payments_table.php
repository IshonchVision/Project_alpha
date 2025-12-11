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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('group_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->enum('payment_method', ['cash', 'card', 'transfer', 'online'])->default('cash');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        // Guruh-Talabalar oraliq jadvali
        Schema::create('group_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->date('enrolled_at')->default(now());
            $table->enum('status', ['active', 'inactive', 'completed', 'dropped'])->default('active');
            $table->timestamps();

            // Bir talaba bir guruhga faqat bir marta qo'shilishi mumkin
            $table->unique(['group_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('group_student');
    }
};
