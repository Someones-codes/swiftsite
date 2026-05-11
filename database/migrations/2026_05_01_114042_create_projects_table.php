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
        // database/migrations/xxxx_create_projects_table.php

Schema::create('projects', function (Blueprint $table) {
    $table->id();
    $table->string('title');                    // Project name
    $table->text('description');                // Full description
    $table->string('short_description', 255);   // Card preview text
    $table->string('image_path')->nullable();   // Uploaded image
    $table->string('tech_stack');               // "Laravel, MySQL, Tailwind"
    $table->string('live_url')->nullable();     // Link to live site
    $table->string('github_url')->nullable();   // Link to repo
    $table->boolean('is_featured')->default(false); // Show on homepage
    $table->integer('sort_order')->default(0);  // Display order
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
