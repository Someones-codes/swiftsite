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
        Schema::create('cv_files', function (Blueprint $table) {
    $table->id();
    $table->string('file_path');             // Storage path
    $table->string('original_name');         // Original filename
    $table->boolean('is_active')->default(true); // Only one active at a time
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_files');
    }
};
