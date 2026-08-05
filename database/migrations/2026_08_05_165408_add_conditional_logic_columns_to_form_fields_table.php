<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_fields', function (Blueprint $table) {

            $table->unsignedBigInteger('parent_field_id')->nullable()->after('sort_order');

            $table->string('condition_operator')->nullable()->after('parent_field_id');

            $table->string('condition_value')->nullable()->after('condition_operator');

        });
    }

    public function down(): void
    {
        Schema::table('form_fields', function (Blueprint $table) {

            $table->dropColumn([
                'parent_field_id',
                'condition_operator',
                'condition_value',
            ]);

        });
    }
};