<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookShelfItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_shelf_id',
        'book_id',
        'position',
        'added_at'
    ];

    protected $casts = [
        'added_at' => 'datetime',
    ];

    public function shelf()
    {
        return $this->belongsTo(BookShelf::class, 'book_shelf_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
