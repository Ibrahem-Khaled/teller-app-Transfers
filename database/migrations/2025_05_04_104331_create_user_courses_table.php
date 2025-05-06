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
        Schema::create('user_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['in_progress', 'completed'])->default('in_progress');
            
            // $table->integer('progress')->default(0); // نسبة التقدم في الدورة
            // $table->integer('last_video_id')->nullable(); // آخر فيديو تم مشاهدته
            // $table->integer('last_video_time')->nullable(); // آخر وقت تم مشاهدته في الفيديو
            // $table->boolean('is_favorite')->default(false); // إذا كان الدورة مفضلة
            // $table->boolean('is_paid')->default(false); // إذا كانت الدورة مدفوعة
            // $table->boolean('is_completed')->default(false); // إذا كانت الدورة مكتملة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_courses');
    }
};
