<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_book_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('library_book_id');
            $table->unsignedInteger('chapter_number')->default(1);
            $table->string('chapter_title', 255)->nullable();
            $table->longText('text_content')->nullable();
            $table->longText('html_content')->nullable();
            $table->unsignedBigInteger('assigned_by_user_id')->nullable();
            $table->timestamps();

            $table->index(['library_book_id', 'chapter_number']);
            $table->foreign('library_book_id')->references('id')->on('library_books')->cascadeOnDelete();
            $table->foreign('assigned_by_user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_book_assignments');
    }
};
