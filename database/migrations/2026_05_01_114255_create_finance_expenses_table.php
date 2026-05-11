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
        Schema::create('finance_expenses', function (Blueprint $table) {
    $table->id();
    $table->string('demo_session_id');
    $table->string('category');             // "Food", "Transport", "Tuition"
    $table->string('description');
    $table->decimal('amount', 10, 2);
    $table->date('expense_date');
    $table->text('notes')->nullable();
    $table->timestamps();
    
    $table->index('demo_session_id');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_expenses');
    }
};
