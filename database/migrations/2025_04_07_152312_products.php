<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('manufacturer_id')->nullable()->constrained('manufacturers')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('tax_id')->nullable()->constrained('taxes')->onDelete('set null');
            $table->foreignId('currency_id')->constrained('currencies')->onDelete('cascade');
    
            $table->string('file_type', 5)->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('available_for_order')->default(true);
            $table->boolean('display_price')->default(true);
            $table->decimal('price', 20, 6)->default(0.000000);
            $table->decimal('green_tax', 14, 6)->default(0.000000);
    
            $table->string('reference', 32)->unique();
            $table->string('manufacturer_reference', 32)->nullable()->unique();
            $table->string('ean13', 32)->nullable()->unique();
    
            $table->float('weight')->nullable();
    
            $table->string('title', 254);
            $table->mediumText('short_description')->nullable();
            $table->mediumText('description')->nullable();
    
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    
            $table->index('manufacturer_id');
            $table->index('category_id');
            $table->index('tax_id');
            $table->index('currency_id');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
