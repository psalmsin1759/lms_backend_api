<?php

use App\Enums\ContentType;
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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')
                  ->constrained('modules')
                  ->onDelete('cascade'); 
            $table->string('title');
            $table->enum('content_type', [
                ContentType::VIDEO->value,
                ContentType::AUDIO->value,
                ContentType::PDF->value,
                ContentType::TEXT->value,
            ])->default(ContentType::TEXT->value);
            $table->string('content_url')->nullable();
            $table->integer('duration')->default(0); // duration in minutes
            $table->integer('order')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
