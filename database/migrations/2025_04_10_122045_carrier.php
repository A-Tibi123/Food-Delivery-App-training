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
        Schema::create('carrier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id')->constrained()->onDelete('cascade');
            $table->foreignId('tax_id')->nullable()->constrained('taxes')->onDelete('set null');
            $table->unsignedTinyInteger('position')->default(0);
            $table->boolean('is_free')->default(false);
            $table->boolean('active')->default(false);
            $table->boolean('deleted')->default(false);
            $table->unsignedInteger('max_width')->default(0);
            $table->unsignedInteger('max_height')->default(0);
            $table->unsignedInteger('max_depth')->default(0);
            $table->decimal('max_weight', 20, 6)->default(0.000000);
            $table->decimal('price', 20, 6)->default(0.000000);
            $table->string('name', 254);
            $table->text('description')->nullable();
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    
            $table->index(['active', 'deleted'], 'active_deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrier');
    }
};
