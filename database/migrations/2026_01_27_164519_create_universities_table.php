<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('location');
            $table->enum('type', ['public', 'private', 'international'])->default('public');
            $table->decimal('ranking', 5, 2)->nullable();
            $table->string('country');
            $table->string('city')->nullable();
            $table->string('website')->nullable();
            $table->text('admission_requirements')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['country', 'type']);
            $table->index('ranking');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};