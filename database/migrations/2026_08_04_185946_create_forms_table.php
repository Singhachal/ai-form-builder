<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forms', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->boolean('is_active')->default(true);

            $table->boolean('is_public')->default(true);

            $table->json('schema')->nullable();

            $table->timestamps();

            $table->index('is_active');

            $table->index('slug');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};