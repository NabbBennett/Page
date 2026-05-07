<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileWriting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_type',
        'user_id',
        'title',
        'text_content',
        'html_content',
        'is_draft',
    ];

    protected $casts = [
        'is_draft' => 'boolean',
    ];
}
