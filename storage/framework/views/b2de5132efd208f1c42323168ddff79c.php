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
        <a href="<?php echo e(route('movies.create')); ?>" class="btn btn-success mb-4">Thêm phim mới</a>

        <!-- Display success message if available -->
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Search Bar -->
        <form action="<?php echo e(route('movies.index')); ?>" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm" value="<?php echo e(request()->input('search')); ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Tìm</button>
                </div>
            </div>
        </form>

        <!-- Movies List -->
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4">
                    <div class="card movie-card">
                        <?php if($movie->poster): ?>
                            <img src="<?php echo e($movie->poster); ?>" class="card-img-top" alt="<?php echo e($movie->title); ?> poster">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Placeholder poster">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($movie->title); ?></h5>
                            <p class="movie-id">ID: <?php echo e($movie->id); ?></p> <!-- ID added here -->
                            <p class="card-text"><?php echo e(Str::limit($movie->intro, 100)); ?></p>
                            <p class="card-text"><small class="text-muted">Genre: <?php echo e($movie->genre->name); ?></small></p>
                            <p class="card-text"><small class="text-muted">Release Date: <?php echo e(\Carbon\Carbon::parse($movie->release_date)->format('d M Y')); ?></small></p>
                            <a href="<?php echo e(route('movies.show', $movie->id)); ?>" class="btn btn-info">Xem chi tiết</a>
                            <a href="<?php echo e(route('movies.edit', $movie->id)); ?>" class="btn btn-warning">Sửa</a>
                            <form action="<?php echo e(route('movies.destroy', $movie->id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        No movies found.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH E:\laragon\www\lab5\resources\views/movies/index.blade.php ENDPATH**/ ?>