<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .movie-card {
            margin-bottom: 20px;
        }
        .movie-card img {
            max-height: 200px;
            object-fit: cover;
        }
        .movie-id {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Danh sách phim</h1>

        <!-- Add Movie Button -->
        <a href="{{ route('movies.create') }}" class="btn btn-success mb-4">Thêm phim mới</a>

        <!-- Display success message if available -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Bar -->
        <form action="{{ route('movies.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm" value="{{ request()->input('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Tìm</button>
                </div>
            </div>
        </form>

        <!-- Movies List -->
        <div class="row">
            @forelse ($movies as $movie)
                <div class="col-md-4">
                    <div class="card movie-card">
                        @if ($movie->poster)
                            <img src="{{ $movie->poster }}" class="card-img-top" alt="{{ $movie->title }} poster">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Placeholder poster">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="movie-id">ID: {{ $movie->id }}</p> <!-- ID added here -->
                            <p class="card-text">{{ Str::limit($movie->intro, 100) }}</p>
                            <p class="card-text"><small class="text-muted">Genre: {{ $movie->genre->name }}</small></p>
                            <p class="card-text"><small class="text-muted">Release Date: {{ \Carbon\Carbon::parse($movie->release_date)->format('d M Y') }}</small></p>
                            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info">Xem chi tiết</a>
                            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No movies found.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
