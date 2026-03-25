<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileWritingAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_writing_id',
        'file_folder_id',
        'image_path',
        'is_encrypted',
        'password',
        'assigned_by_user_id',
    ];

    protected $casts = [
        'is_encrypted' => 'boolean',
    ];
}
