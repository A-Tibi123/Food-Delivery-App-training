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
    Schema::create('carts', function (Blueprint $table) {
        $table->id();

        $table->foreignId('currency_id')->constrained()->onDelete('cascade');
        $table->foreignId('client_id')->nullable()->constrained()->onDelete('set null');

        $table->foreignId('address_invoice')->nullable()->constrained('client_addresses')->onDelete('set null');
        $table->foreignId('address_delivery')->nullable()->constrained('client_addresses')->onDelete('set null');

        $table->foreignId('carrier_id')->nullable()->constrained('carriers')->onDelete('set null');
        $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('set null');

        $table->decimal('total_products', 20, 6)->default(0.000000);
        $table->decimal('total_taxes', 20, 6)->default(0.000000);
        $table->decimal('total_discounts', 20, 6)->default(0.000000);
        $table->decimal('total_delivery', 20, 6)->default(0.000000);
        $table->decimal('total', 20, 6)->default(0.000000);

        $table->boolean('active')->default(true);
        $table->string('identifier', 32)->unique();

        $table->string('client_name', 254)->nullable();
        $table->string('client_email', 254)->nullable();
        $table->string('client_phone', 32)->nullable();

        $table->dateTime('created_at');
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

        $table->unique(['client_id', 'identifier']);
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
};
