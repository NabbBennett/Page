<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_writing_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_writing_id');
            $table->unsignedBigInteger('file_folder_id')->nullable();
            $table->longText('image_path')->nullable();
            $table->boolean('is_encrypted')->default(false);
            $table->string('password', 255)->nullable();
            $table->unsignedBigInteger('assigned_by_user_id')->nullable();
            $table->timestamps();

            $table->index(['file_writing_id']);
            $table->index(['file_folder_id']);
            $table->foreign('file_writing_id')->references('id')->on('file_writings')->cascadeOnDelete();
            $table->foreign('file_folder_id')->references('id')->on('file_folders')->nullOnDelete();
            $table->foreign('assigned_by_user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_writing_assignments');
    }
};
