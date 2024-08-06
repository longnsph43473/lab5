<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <!-- Link đến Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .movie-details {
            margin-top: 20px;
        }
        .movie-details img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container movie-details">
        <h1 class="mb-4">Chi tiết</h1>

        <!-- Hiển thị thông báo thành công hoặc lỗi -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Thông tin phim -->
        <div class="row">
            <div class="col-md-4">
                @if ($movie->poster)
                    <img src="{{ asset($movie->poster) }}" alt="Poster Image" class="img-fluid">
                @else
                    <p>No poster available</p>
                @endif

            </div>
            <div class="col-md-8">
                <h2>{{ $movie->title }}</h2>
                <p><strong>Genre:</strong> {{ $movie->genre->name }}</p>
                <p><strong>Release Date:</strong> {{ \Carbon\Carbon::parse($movie->release_date)->format('d M Y') }}</p>
                <p><strong>Introduction:</strong></p>
                <p>{{ $movie->intro }}</p>
                
                <!-- Các nút chức năng -->
                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Sửa</a>
                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
                <a href="{{ route('movies.index') }}" class="btn btn-secondary">Trở về</a>
            </div>
        </div>
    </div>

    <!-- Link đến Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
