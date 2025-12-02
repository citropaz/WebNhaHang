<?php
session_start();

include("connection.php");
include("foodcon.php");
include("functions.php");

kickout($con);

if (isset($_GET["id"]))
{
    $id = $_GET["id"];

    $query_select = "SELECT food_img FROM food WHERE id = $id LIMIT 1";
    $result = mysqli_query($foodcon, $query_select);

    if ($result && mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        $image = $row['food_img'];

        if (!empty($image) && file_exists("./images/freezer/" . $image))
        {
            unlink("./images/freezer/" . $image);
        }

        $query_delete = "DELETE FROM food WHERE id = $id";
        mysqli_query($foodcon, $query_delete);
    }
}

header("Location: editfood.php");
die;
