<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Trang Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Greeting Card -->
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-3">Xin chào, <?php echo htmlspecialchars($user_data['username']); ?>!</h3>
                        <p class="card-text">Chào mừng bạn đến trang quản lý.</p>

                        <!-- Buttons -->
                        <div class="d-grid gap-3 col-8 mx-auto">
                            <a href="index.html" class="btn btn-outline-primary btn-lg">Trang chủ</a>
                            <a href="editfood.php" class="btn btn-primary btn-lg">Quản lý thực đơn</a>
                            <a href="changepassword.php" class="btn btn-warning btn-lg text-white">Đổi mật khẩu</a>
                            <a href="signup.php" class="btn btn-success btn-lg">Đăng ký</a>
                            <a href="logout.php" class="btn btn-danger btn-lg">Đăng xuất</a>
                        </div>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>
