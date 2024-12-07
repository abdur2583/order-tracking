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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('shipping_address_id'); 
            $table->string('order_number')->unique(); 
            $table->decimal('total_amount'); 
            $table->enum('status', ['pending', 'in_progress', 'delivered'])->default('pending'); 
            $table->timestamp('placed_at')->nullable();

            $table->timestamp( "updated_at" )->useCurrent()->useCurrentOnUpdate();
            $table->timestamp( "created_at" )->useCurrent();
            // Foreign key constraints 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('shipping_address_id')->references('id')->on('shipping_addresses')->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
