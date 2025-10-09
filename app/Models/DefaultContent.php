<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type',
        'content_type',
        'title',
        'content',
    ];
}
