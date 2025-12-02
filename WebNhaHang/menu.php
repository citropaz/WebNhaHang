<?php
session_start();

include("connection.php");
include("foodcon.php");
include("functions.php");

$queryapp = "select * from food where food_type = 'app'";
$resultapp = mysqli_query($foodcon, $queryapp);

$querymain = "select * from food where food_type = 'main'";
$resultmain = mysqli_query($foodcon, $querymain);

$querydess = "select * from food where food_type = 'dess'";
$resultdess = mysqli_query($foodcon, $querydess);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thực đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <!--Thanh Điều Hướng-->

    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="./images/logo.jpg" width="200" height="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto d-flex justify-content-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Thực Đơn</a>
                    </li>
                </ul>

                <a href="login.php">
                    <img src="./icons/login.svg">
                </a>
            </div>
        </div>
    </nav>

    <!--Mô Tả Thực Đơn-->

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 intro-text">
                <h2>Thực đơn mùa đông</h2>
                <p>Mùa đông đến mang theo những cơn gió lạnh và mong muốn được thưởng thức những món ăn đầy hương vị, bổ
                    dưỡng. Thực đơn mùa đông của chúng tôi tập trung vào các món nóng hổi, giàu dinh dưỡng và tinh tế,
                    giúp sưởi ấm cơ thể và tâm hồn.</p>
            </div>
        </div>
    </div>

    <!--Thực Đơn-->

    <div class="container">
        <ul class="nav nav-pills mb-3 justify-content-center" style="gap: 20px;" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-appetizer-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-appetizer" type="button" role="tab" aria-controls="pills-appetizer"
                    aria-selected="true">Khai Vị</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-main-tab" data-bs-toggle="pill" data-bs-target="#pills-main"
                    type="button" role="tab" aria-controls="pills-main" aria-selected="true">Món Chính</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-dessert-tab" data-bs-toggle="pill" data-bs-target="#pills-dessert"
                    type="button" role="tab" aria-controls="pills-dessert" aria-selected="true">Tráng Miệng</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-appetizer" role="tabpanel" aria-labelledby="pills-appetizer-tab" tabindex="0">

                <div class="row mt-5">

                    <?php

                    if (mysqli_num_rows($resultapp) > 0)
                    {
                        while ($row = $resultapp->fetch_assoc())
                        {
                            echo "
                                <div class='col-lg-3 col-sm-6'>
                                    <div class='appetizer-item'>
                                        <img id='food-img' src='./images/freezer/$row[food_img]'>
                                        <div class='menu-item-content'>
                                            <h5>$row[food_name]</h5>
                                            <p>$row[food_des]</p>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                    }
                    else
                    {
                        echo "<h5 class='mb-5'>Hiện chưa có món khai vị nào</h5>";
                    }

                    ?>

                </div>

            </div>

            <div class="tab-pane fade" id="pills-main" role="tabpanel" aria-labelledby="pills-main-tab" tabindex="0">

                <div class="row mt-5">

                    <?php

                    if (mysqli_num_rows($resultmain) > 0)
                    {
                        while ($row = $resultmain->fetch_assoc())
                        {
                            echo "
                                <div class='col-lg-3 col-sm-6'>
                                    <div class='main-item'>
                                        <img id='food-img' src='./images/freezer/$row[food_img]'>
                                        <div class='menu-item-content'>
                                            <h5>$row[food_name]</h5>
                                            <p>$row[food_des]</p>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                    }
                    else
                    {
                        echo "<h5 class='mb-5'>Hiện chưa có món chính nào</h5>";
                    }

                    ?>

                </div>

            </div>

            <div class="tab-pane fade" id="pills-dessert" role="tabpanel" aria-labelledby="pills-dessert-tab" tabindex="0">

                <div class="row mt-5">
                    
                <?php

                    if (mysqli_num_rows($resultdess) > 0)
                    {
                        while ($row = $resultdess->fetch_assoc())
                        {
                            echo "
                                <div class='col-lg-3 col-sm-6'>
                                    <div class='dess-item'>
                                        <img id='food-img' src='./images/freezer/$row[food_img]'>
                                        <div class='menu-item-content'>
                                            <h5>$row[food_name]</h5>
                                            <p>$row[food_des]</p>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                    }
                    else
                    {
                        echo "<h5 class='mb-5'>Hiện chưa có món tráng miệng nào</h5>";
                    }

                    ?>

                </div>

            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>