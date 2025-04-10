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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
    
            $table->string('code', 16)->unique();
            $table->string('name', 254);
            $table->text('description')->nullable();
            $table->boolean('is_prepay')->default(false);
            $table->boolean('active')->default(false);
            $table->unsignedTinyInteger('position')->default(0);
    
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    
            $table->index('active');
            $table->index('is_prepay');
            $table->index('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
