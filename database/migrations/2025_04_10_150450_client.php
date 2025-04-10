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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('default_address_id')->nullable()->constrained('client_addresses')->onDelete('set null');
    
            $table->string('email', 254)->unique();
            $table->string('firstname', 254);
            $table->string('lastname', 254);
            $table->enum('sex', ['F', 'M'])->nullable();
            $table->string('phone', 32)->nullable();
            $table->date('birth_date')->nullable();
    
            $table->smallInteger('status')->default(10);
    
            $table->string('auth_key', 32)->nullable()->unique();
            $table->string('password_hash', 254)->nullable();
            $table->string('password_reset_token', 254)->nullable()->unique();
    
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
