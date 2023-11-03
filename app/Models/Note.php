<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'attachments',
        'note',
    ];

    protected $casts = [
        'attachments' => 'array'
    ];
}
