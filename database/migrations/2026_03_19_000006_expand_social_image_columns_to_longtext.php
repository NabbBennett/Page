<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE social_users MODIFY icon_path LONGTEXT NULL');
        DB::statement('ALTER TABLE social_users MODIFY banner_path LONGTEXT NULL');
        DB::statement('ALTER TABLE social_posts MODIFY image_path LONGTEXT NULL');
        DB::statement('ALTER TABLE social_comments MODIFY image_path LONGTEXT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE social_users MODIFY icon_path VARCHAR(255) NULL');
        DB::statement('ALTER TABLE social_users MODIFY banner_path VARCHAR(255) NULL');
        DB::statement('ALTER TABLE social_posts MODIFY image_path VARCHAR(255) NULL');
        DB::statement('ALTER TABLE social_comments MODIFY image_path VARCHAR(255) NULL');
    }
};
