<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'pages_read',
        'reading_time',
        'notes',
        'logged_at'
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
