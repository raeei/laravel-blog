<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('post_title');
            $table->string('featured_picture');
            $table->string('body');
            $table->string('editor_id');
            $table->string('category');
            $table->string('status')->nullable();
            $table->string('watermark')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('approved_by_id')->nullable();
            $table->timestamp('edited_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};