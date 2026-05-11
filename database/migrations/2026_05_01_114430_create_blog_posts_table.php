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
        Schema::create('blog_posts', function (Blueprint $table) {
    $table->id();
    $table->string('demo_session_id');
    $table->string('author_name');           // Guest or demo user name
    $table->string('title');
    $table->text('body');
    $table->integer('likes')->default(0);
    $table->timestamps();
    
    $table->index('demo_session_id');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
