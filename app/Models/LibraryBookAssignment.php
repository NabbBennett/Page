<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryBookAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'library_book_id',
        'chapter_number',
        'chapter_title',
        'text_content',
        'html_content',
        'assigned_by_user_id',
    ];
}
