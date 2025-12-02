<?php
session_start();

include("connection.php");
include("foodcon.php");
include("functions.php");

kickout($con);

$query = "select * from food order by field(food_type, 'app', 'main', 'dess')";
$result = mysqli_query($foodcon, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý thực đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">
</head>

<body>

    <a href="admin.php">
        <img src="./icons/back.svg">
    </a>

    <div class="container my-5">
        <h2>Thực đơn</h2>
        <a class="btn btn-primary" href="createdish.php" role="button">Thêm món ăn</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Loại món ăn</th>
                    <th>Tên món ăn</th>
                    <th>Mô tả món ăn</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc())
                {
                    $type_name = '';
                    if ($row['food_type'] == 'app') $type_name = 'Khai vị';
                    elseif ($row['food_type'] == 'main') $type_name = 'Món chính';
                    elseif ($row['food_type'] == 'dess') $type_name = 'Tráng miệng';
                    echo "<tr>
                        <td>
                            <img src='./images/freezer/$row[food_img]' style='width:400px; height:170px; object-fit:cover; border-radius:6px;'>
                        </td>
                        <td>$type_name</td>
                        <td>$row[food_name]</td>
                        <td>$row[food_des]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='editdish.php?id=$row[id]'>Sửa</a>
                            <a class='btn btn-danger btn-sm' href='deletedish.php?id=$row[id]'>Xóa</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>