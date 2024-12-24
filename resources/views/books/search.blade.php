<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Search for Books</h1>
        <form action="{{ route('books.search') }}" method="GET">
            <div class="form-group">
                <label for="query">Search Query:</label>
                <input type="text" id="query" name="query" class="form-control" placeholder="Enter book title or author">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        @if(isset($books))
            <h2>Search Results:</h2>
            <ul>
                @forelse($books as $book)
                    <li>{{ $book->title }} by {{ $book->author }}</li>
                @empty
                    <li>No books found.</li>
                @endforelse
            </ul>
        @endif
    </div>
</body>
</html>
