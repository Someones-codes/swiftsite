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
        Schema::create('water_payments', function (Blueprint $table) {
    $table->id();
    $table->string('demo_session_id');
    $table->foreignId('water_customer_id')->constrained()->onDelete('cascade');
    $table->decimal('amount_paid', 8, 2);
    $table->date('payment_date');
    $table->enum('status', ['pending', 'partial', 'complete'])->default('pending');
    $table->text('notes')->nullable();
    $table->timestamps();
    
    $table->index('demo_session_id');
    $table->index('status');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_payments');
    }
};
