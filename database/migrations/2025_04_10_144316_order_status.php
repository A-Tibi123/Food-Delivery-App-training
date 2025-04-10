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
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
    
            $table->boolean('active')->default(true);
            $table->string('name', 254);
            $table->string('color', 16)->nullable();
            $table->boolean('validated')->default(false);
            $table->boolean('invoiced')->default(false);
            $table->boolean('shipped')->default(false);
            $table->boolean('finalised')->default(false);
    
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    
            $table->index('active');
            $table->index('validated');
            $table->index('invoiced');
            $table->index('shipped');
            $table->index('finalised');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status');
    }
};
