<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_generations', function (Blueprint $table) {

            $table->id();

            $table->string('prompt');

            $table->foreignId('form_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->longText('response')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_generations');
    }
};