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
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Thông tin phim -->
        <div class="row">
            <div class="col-md-4">
                <?php if($movie->poster): ?>
                    <img src="<?php echo e(asset($movie->poster)); ?>" alt="Poster Image" class="img-fluid">
                <?php else: ?>
                    <p>No poster available</p>
                <?php endif; ?>

            </div>
            <div class="col-md-8">
                <h2><?php echo e($movie->title); ?></h2>
                <p><strong>Genre:</strong> <?php echo e($movie->genre->name); ?></p>
                <p><strong>Release Date:</strong> <?php echo e(\Carbon\Carbon::parse($movie->release_date)->format('d M Y')); ?></p>
                <p><strong>Introduction:</strong></p>
                <p><?php echo e($movie->intro); ?></p>
                
                <!-- Các nút chức năng -->
                <a href="<?php echo e(route('movies.edit', $movie->id)); ?>" class="btn btn-warning">Sửa</a>
                <form action="<?php echo e(route('movies.destroy', $movie->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
                <a href="<?php echo e(route('movies.index')); ?>" class="btn btn-secondary">Trở về</a>
            </div>
        </div>
    </div>

    <!-- Link đến Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH E:\laragon\www\lab5\resources\views/movies/show.blade.php ENDPATH**/ ?>