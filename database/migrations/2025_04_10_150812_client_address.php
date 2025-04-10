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
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->constrained('states')->onDelete('set null');
    
            $table->boolean('active')->default(true);
            $table->unsignedTinyInteger('district')->nullable();
    
            $table->string('city', 64);
            $table->string('street', 254);
            $table->string('street_nb', 32)->nullable();
            $table->string('other', 254)->nullable();
            $table->string('postcode', 12)->nullable();
    
            $table->enum('pj_pf', ['pf', 'pj'])->default('pf');
            $table->string('company_name', 254)->nullable();
            $table->string('cui', 16)->nullable();
            $table->string('nr_reg', 16)->nullable();
            $table->string('bank', 64)->nullable();
            $table->string('iban', 64)->nullable();
            $table->text('observations')->nullable();
    
            $table->unsignedInteger('website_address_id')->nullable()->unique();
    
            $table->dateTime('created_at');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    
            $table->index(['client_id', 'active'], 'client_active');
            $table->index(['country_id', 'state_id'], 'country_state');
            $table->index('district');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_address');
    }
};
