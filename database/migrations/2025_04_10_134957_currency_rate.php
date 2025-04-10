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
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('reference_currency_id')->constrained('currencies')->onDelete('cascade');
            $table->foreignId('currency_id')->constrained('currencies')->onDelete('cascade');
    
            $table->date('valability_date');
            $table->decimal('conversion_rate', 20, 6)->unsigned();
    
            $table->timestamps();
    
            $table->unique(['currency_id', 'valability_date'], 'currency_id_valability_date');
            $table->index('valability_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_rate');
    }
};
