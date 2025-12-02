<?php
session_start();

include("connection.php");
include("functions.php");

check_loginalready($con);

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password) && !is_numeric($username))
    {
        $query = "select * from users where username = '$username' limit 1";
        $result = mysqli_query($con, $query);
        if ($result)
        {
            if ($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] === $password)
                {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: admin.php");
                    die;
                }
            }
        }
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
    else
    {
        $error = "Vui lòng nhập username và password hợp lệ!";
    }
}

if (isset($_SESSION['error']))
{
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">
</head>

<body>

    <div class="d-flex justify-content-center align-items-center vh-100 bg-light bg-gradient-custom">
        <div class="p-4 bg-glass rounded-4 shadow-lg" style="width: 350px;">

            <a href="index.html">
                <img src="./icons/back.svg">
            </a>

            <form method="post">
                <h4 class="text-center mb-4 fw-bold">Đăng nhập</h4>

                <?php if (!empty($error)): ?>
                    <div class="text-danger text-center mb-3"><?php echo $error; ?></div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control" type="text" name="username">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>

                    <div class="input-group">
                        <input class="form-control" type="password" id="password" name="password">
                        <button class="btn" type="button" id="togglePassword">
                            <img id="icon-eye" src="./icons/hide.svg">
                        </button>
                    </div>
                </div>

                <button class="login-btn">
                    Đăng nhập
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const pass = document.getElementById('password');
            const icon = document.getElementById('icon-eye');

            const isPassword = pass.getAttribute('type') === 'password';
            pass.setAttribute('type', isPassword ? 'text' : 'password');

            icon.src = isPassword ? "./icons/show.svg" : "./icons/hide.svg";
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>