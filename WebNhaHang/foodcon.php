<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "food_db";

if (!$foodcon = mysqli_connect($dbhost, $dbuser, $dbpassword,  $dbname)) {
    die("failed to connect!");
}
