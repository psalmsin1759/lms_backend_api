<?php

use App\Enums\CourseLevel;
use App\Enums\CourseStatus;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id');
            $table->string('title')->unique();
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->enum('level', [
                CourseLevel::BEGINNER->value,
                CourseLevel::INTERMEDIATE->value,
                CourseLevel::ADVANCED->value
            ])->default(CourseLevel::BEGINNER->value);
            $table->integer('duration')->default(0); // Duration in minutes
            $table->decimal('price', 10, 2)->default(0);
            $table->enum('status', [
                CourseStatus::DRAFT->value,
                CourseStatus::PUBLISHED->value,
                CourseStatus::ARCHIVED->value
            ])->default(CourseStatus::DRAFT->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
