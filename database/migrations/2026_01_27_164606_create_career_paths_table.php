<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_paths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('major_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('average_salary')->nullable();
            $table->enum('demand_level', ['low', 'medium', 'high', 'very_high'])->nullable();
            $table->timestamps();
            
            $table->index('major_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_paths');
    }
};