<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'layout',
        'content', // JSON for sections data
        // 'sections', // JSON for sections data
        'meta_image',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'timestamps',
    ];

    protected $casts = [
        'content' => 'array',
        'meta_keywords' => 'array',
    ];
}
