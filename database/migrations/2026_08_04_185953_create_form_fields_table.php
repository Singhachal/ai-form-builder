<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_fields', function (Blueprint $table) {

            $table->id();

            $table->foreignId('form_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('label');

            $table->string('name');

            $table->string('type');

            $table->string('placeholder')->nullable();

            $table->text('help_text')->nullable();

            $table->text('default_value')->nullable();

            $table->boolean('required')->default(false);

            $table->json('options')->nullable();

            $table->json('validation')->nullable();

            $table->integer('sort_order')->default(0);

            $table->timestamps();

            $table->index('form_id');

            $table->index('type');

            $table->index('sort_order');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};