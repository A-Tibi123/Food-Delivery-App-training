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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->string('iso_code', 2)->unique();
            $table->string('language_code', 5);
            $table->string('date_format_lite', 32)->default('Y-m-d');
            $table->string('date_format_full', 32)->default('Y-m-d H:i:s');
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('active')->default(false);
            $table->boolean('is_rtl')->default(false);
            $table->timestamps();
    
            $table->index('display_order', 'order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language');
    }
};
