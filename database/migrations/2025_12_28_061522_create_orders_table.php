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
        
        // Link to User
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // Customer Information (from the checkout form)
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email');
        $table->string('phone');
        
        // Delivery Address
        $table->string('address');
        $table->string('city');
        $table->string('zip_code');
        
        // Order Details
        $table->string('payment_method');
        $table->decimal('total_amount', 10, 2);
        $table->string('status')->default('pending'); // pending, completed, cancelled
        
        $table->timestamps();
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
