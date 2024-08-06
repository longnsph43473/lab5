<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Movie</title>
    <!-- Link đến Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <h1 class="mb-4">Add New Movie</h1>

        <!-- Hiển thị thông báo thành công hoặc lỗi -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form thêm phim -->
        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Trường tiêu đề -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Trường thể loại -->
            <div class="form-group">
                <label for="genre_id">Genre</label>
                <select name="genre_id" id="genre_id" class="form-control @error('genre_id') is-invalid @enderror" required>
                    <option value="">Select Genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
                @error('genre_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Trường ngày phát hành -->
            <div class="form-group">
                <label for="release_date">Release Date</label>
                <input type="date" name="release_date" id="release_date" class="form-control @error('release_date') is-invalid @enderror" value="{{ old('release_date') }}" required>
                @error('release_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Trường hình ảnh poster -->
            <div class="form-group">
                <label for="poster">Poster Image</label>
                <input type="file" name="poster" id="poster" class="form-control-file @error('poster') is-invalid @enderror">
                @error('poster')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Trường giới thiệu -->
            <div class="form-group">
                <label for="intro">Introduction</label>
                <textarea name="intro" id="intro" class="form-control @error('intro') is-invalid @enderror" rows="5" required>{{ old('intro') }}</textarea>
                @error('intro')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Nút chức năng -->
            <button type="submit" class="btn btn-primary">Thêm phim</button>
            <a href="{{ route('movies.index') }}" class="btn btn-secondary">Trở về</a>
        </form>
    </div>

    <!-- Link đến Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
