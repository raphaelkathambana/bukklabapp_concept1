<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title', 'isbn',
        'pages',
        'description',
        'cover_image',
        'language',
        'published_date',
        'series_id',
        'series_order'
    ];

    public function scopeSearch(Builder $query, string $term): Builder
    {
        return $query->where('title', 'like', "%{$term}%")
            ->orWhere('isbn', 'like', "%{$term}%")
            ->orWhereHas('authors', function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%");
            });
    }

    public function readingLogs()
    {
        return $this->hasMany(ReadingLog::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_books')
            ->withPivot('status', 'current_page', 'started_at', 'completed_at')
            ->withTimestamps();
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors')->withPivot('author_order');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genres');
    }

    public function shelfItems()
    {
        return $this->hasMany(BookShelfItem::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language', 'code');
    }

    public function series()
    {
        return $this->belongsTo(Book::class, 'series_id');
    }

    public function seriesBooks()
    {
        return $this->hasMany(Book::class, 'series_id');
    }
}
