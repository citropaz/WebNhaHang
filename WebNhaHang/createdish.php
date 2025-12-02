<?php
session_start();

include("connection.php");
include("foodcon.php");
include("functions.php");

$error = "";
$succ = "";

kickout($con);

$food_id = "";
$food_type = "";
$food_name = "";
$food_des = "";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $food_type = $_POST['food_type'];
    $food_name = $_POST['food_name'];
    $food_des = $_POST['food_des'];

    $food_img = null;
    if (isset($_FILES['food_img']) && $_FILES['food_img']['error'] == 0) {

        $img_name = time() . "_" . basename($_FILES['food_img']['name']);
        $target_path = "./images/freezer/" . $img_name;

        $allowed = ['jpg','jpeg','png','webp'];
        $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            move_uploaded_file($_FILES['food_img']['tmp_name'], $target_path);
            $food_img = $img_name;
        }
    }

    if (!empty($food_name) && !empty($food_des) && !is_numeric($food_name) && !is_numeric($food_des))
    {
        $food_id = random_num(20);

        $query = "insert into food (food_id, food_type, food_name, food_des, food_img) values ('$food_id', '$food_type', '$food_name', '$food_des', '$food_img')";
        mysqli_query($foodcon, $query);

        $succ = "Thêm món ăn thành công!";
    }
    else
    {
        $error = "Vui lòng điền đủ, đúng tên và thông tin món ăn!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm món ăn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">
</head>

<body>
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="mb-4 text-center">Thêm món ăn mới</h2>

                <?php if (!empty($error)): ?>
                    <div class="text-danger text-center mb-3"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if (!empty($succ)): ?>
                    <div class="text-success text-center mb-3"><?php echo $succ; ?></div>
                <?php endif; ?>

                <form method="post" enctype="multipart/form-data">

                    <div class="mb-3 row align-items-center">
                        <label class="col-sm-3 col-form-label">Ảnh món ăn</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="food_img" accept="image/*">
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label class="col-sm-3 col-form-label">Loại món ăn</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="food_type">
                                <option value="app" <?php if ($food_type == "app") echo "selected"; ?>>Khai vị</option>
                                <option value="main" <?php if ($food_type == "main") echo "selected"; ?>>Món chính</option>
                                <option value="dess" <?php if ($food_type == "dess") echo "selected"; ?>>Tráng miệng</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label class="col-sm-3 col-form-label">Tên món ăn</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="food_name" value="<?php echo htmlspecialchars($food_name); ?>">
                        </div>
                    </div>

                    <div class="mb-3 row align-items-start">
                        <label class="col-sm-3 col-form-label">Mô tả món ăn</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="food_des" rows="4"><?php echo htmlspecialchars($food_des); ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6 d-grid">
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                        <div class="col-sm-6 d-grid">
                            <a class="btn btn-outline-secondary" href="editfood.php">Quay về</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>