<?php
session_start();

include("connection.php");
include("functions.php");

kickout($con);

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == "POST")
{

    $old = $_POST['oldpassword'];
    $new = $_POST['newpassword'];

    if (!empty($old) && !empty($new))
    {
        $query = "SELECT * FROM users WHERE user_id = '$user_id' LIMIT 1";
        $result = mysqli_query($con, $query);
        $user_data = mysqli_fetch_assoc($result);

        if ($user_data['password'] === $old)
        {
            $update = "UPDATE users SET password = '$new' WHERE user_id = '$user_id'";
            mysqli_query($con, $update);

            $succ = "Đổi mật khẩu thành công!";
            $error = "";
        }
        else
        {
            $error = "Mật khẩu cũ không chính xác!";
        }
    }
    else
    {
        $error = "Vui lòng nhập đủ mật khẩu cũ và mật khẩu mới!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đổi mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">
</head>

<body>

    <div class="d-flex justify-content-center align-items-center vh-100 bg-gradient-custom2">
        <div class="p-4 bg-glass rounded-4 shadow-lg" style="width: 350px;">
            <form method="post">

                <a href="admin.php">
                    <img src="./icons/back.svg">
                </a>

                <h4 class="text-center mb-4 fw-bold">Đổi mật khẩu</h4>

                <?php if (!empty($succ)): ?>
                    <div class="text-success text-center mb-3"><?php echo $succ; ?></div>
                <?php endif; ?>

                <?php if (!empty($error)): ?>
                    <div class="text-danger text-center mb-3"><?php echo $error; ?></div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu cũ</label>
                    <div class="input-group">
                        <input class="form-control" type="password" name="oldpassword" id="oldPassword">
                        <button type="button" class="btn" id="toggleOld">
                            <img src="./icons/hide.svg" id="oldIcon">
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu mới</label>
                    <div class="input-group">
                        <input class="form-control" type="password" name="newpassword" id="newPassword">
                        <button type="button" class="btn" id="toggleNew">
                            <img src="./icons/hide.svg" id="newIcon">
                        </button>
                    </div>
                </div>

                <button class="login-btn">
                    Xác nhận
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.src = "./icons/show.svg";
            } else {
                input.type = "password";
                icon.src = "./icons/hide.svg";
            }
        }

        document.getElementById("toggleOld").onclick = () =>
            togglePassword("oldPassword", "oldIcon");

        document.getElementById("toggleNew").onclick = () =>
            togglePassword("newPassword", "newIcon");
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>