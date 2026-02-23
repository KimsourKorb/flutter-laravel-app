<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('major_university', function (Blueprint $table) {
            $table->id();
            $table->foreignId('major_id')->constrained()->onDelete('cascade');
            $table->foreignId('university_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['major_id', 'university_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('major_university');
    }
};