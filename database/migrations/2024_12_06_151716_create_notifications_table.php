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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id'); 
            $table->string('type'); 
            $table->text('data'); 
            $table->boolean('read')->default(false); 
            $table->timestamp('read_at')->nullable(); 
            
            $table->timestamp( "updated_at" )->useCurrent()->useCurrentOnUpdate();
            $table->timestamp( "created_at" )->useCurrent();
             // Foreign key constraints 
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
