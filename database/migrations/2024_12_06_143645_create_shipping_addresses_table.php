<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create( 'shipping_addresses', function ( Blueprint $table ) {
            $table->id(); 
            $table->unsignedBigInteger( 'user_id' ); 
            $table->string( 'address_line_1' ); 
            $table->string( 'address_line_2' )->nullable(); 
            $table->string( 'city' ); 
            $table->string( 'state' ); 
            $table->string( 'postal_code' ); 
            $table->string( 'country' ); 

            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
            
            $table->timestamp( "updated_at" )->useCurrent()->useCurrentOnUpdate();
            $table->timestamp( "created_at" )->useCurrent();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists( 'shipping_addresses' );
    }
};
