<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_type',
        'user_id',
        'title',
        'author',
        'description',
        'status',
        'cover_path',
    ];
}
