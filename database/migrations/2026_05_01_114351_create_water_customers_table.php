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
        Schema::create('water_customers', function (Blueprint $table) {
    $table->id();
    $table->string('demo_session_id');
    $table->string('name');
    $table->string('phone')->nullable();
    $table->string('area')->nullable();         // Delivery area
    $table->integer('drums_ordered');
    $table->decimal('price_per_drum', 8, 2);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
    
    $table->index('demo_session_id');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_customers');
    }
};
