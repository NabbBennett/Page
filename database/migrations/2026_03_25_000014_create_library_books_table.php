<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_books', function (Blueprint $table) {
            $table->id();
            $table->string('user_type', 20);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title', 255);
            $table->string('author', 255);
            $table->longText('description')->nullable();
            $table->string('status', 60)->default('En emisión');
            $table->longText('cover_path')->nullable();
            $table->timestamps();

            $table->index(['user_type', 'user_id']);
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_books');
    }
};
