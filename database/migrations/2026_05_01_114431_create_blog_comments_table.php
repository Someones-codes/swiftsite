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
        Schema::create('blog_comments', function (Blueprint $table) {
    $table->id();
    $table->string('demo_session_id');
    $table->foreignId('blog_post_id')->constrained()->onDelete('cascade');
    $table->string('author_name');
    $table->text('content');
    $table->timestamps();
    
    $table->index('demo_session_id');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
    }
};
