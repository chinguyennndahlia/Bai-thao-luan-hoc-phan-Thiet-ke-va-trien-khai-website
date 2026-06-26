<?php
$conn = mysqli_connect("localhost", "root", "", "banahills");
if (!$conn) {
    die("Kết nối Database thất bại: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
?>