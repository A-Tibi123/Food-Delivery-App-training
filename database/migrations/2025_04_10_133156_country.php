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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('iso_code', 3)->unique();
            $table->string('name', 254);
            $table->unsignedInteger('call_prefix')->default(0);
            $table->string('zip_code_format', 12)->default('');
            $table->boolean('need_zip_code')->default(true);
            $table->boolean('active')->default(false);
            $table->boolean('contains_states')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country');
    }
};
