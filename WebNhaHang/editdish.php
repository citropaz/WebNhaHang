<?php
session_start();

include("connection.php");
include("foodcon.php");
include("functions.php");

$error = "";
$succ = "";

kickout($con);

if (!isset($_GET['id']) || empty($_GET['id']))
{
    header("Location: editfood.php");
}

$id = $_GET['id'];

$query = "SELECT * FROM food WHERE id = '$id' LIMIT 1";
$result = mysqli_query($foodcon, $query);

$row = mysqli_fetch_assoc($result);

$food_type = $row['food_type'];
$food_name = $row['food_name'];
$food_des = $row['food_des'];

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $food_type = $_POST['food_type'];
    $food_name = $_POST['food_name'];
    $food_des = $_POST['food_des'];

    if (!empty($food_name) && !empty($food_des) && !is_numeric($food_name) && !is_numeric($food_des))
    {
        $update = "UPDATE food SET food_type='$food_type', food_name='$food_name', food_des='$food_des' WHERE id='$id'";
        mysqli_query($foodcon, $update);
        $succ = "Cập nhật món ăn thành công!";
        $error = "";
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
    <title>Sửa món ăn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/admin.css">
</head>

<body>
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="mb-4 text-center">Sửa món ăn</h2>

                <?php if (!empty($error)): ?>
                    <div class="text-danger text-center mb-3"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if (!empty($succ)): ?>
                    <div class="text-success text-center mb-3"><?php echo $succ; ?></div>
                <?php endif; ?>


                <form method="post" enctype="multipart/form-data">

                    <div class="mb-3 row align-items-center">
                        <label class="col-sm-3 col-form-label">Ảnh hiện tại</label>
                        <div class="col-sm-9">
                            <?php if (!empty($row['food_img'])): ?>
                                <img src="./images/freezer/<?php echo $row['food_img']; ?>"
                                    style="width:120px; height:120px; object-fit:cover; border-radius:8px;">
                            <?php else: ?>
                                <div>Chưa có ảnh</div>
                            <?php endif; ?>
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
                            <input type="text" class="form-control" name="food_name"
                                value="<?php echo htmlspecialchars($food_name); ?>">
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
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                        <div class="col-sm-6 d-grid">
                            <a class="btn btn-outline-secondary" href="editfood.php">Quay về</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>