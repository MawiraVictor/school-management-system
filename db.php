<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "school_sms";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed");
}
?>