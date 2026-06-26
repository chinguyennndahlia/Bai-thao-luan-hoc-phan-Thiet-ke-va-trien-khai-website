<?php 
include '../config/database.php';
include '../core_shared/header.php';

if (isset($_POST['btn_register'])) {
    $u = mysqli_real_escape_string($conn, $_POST['user']);
    $p = mysqli_real_escape_string($conn, $_POST['pass']); // Lưu trực tiếp

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$u'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Tên đăng nhập đã tồn tại!');</script>";
    } else {
        // Lưu mật khẩu $p trực tiếp, không qua hàm password_hash
        $sql = "INSERT INTO users (username, password, role) VALUES ('$u', '$p', 'customer')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Đăng ký thành công!'); window.location.href='login.php';</script>";
        }
    }
}
?>

<div style="width: 350px; margin: 50px auto; border: 1px solid #ddd; padding: 20px;">
    <h2>ĐĂNG KÝ</h2>
    <form method="POST">
        Tên đăng nhập: <br><input type="text" name="user" required style="width:100%"><br><br>
        Mật khẩu: <br><input type="password" name="pass" required style="width:100%"><br><br>
        <button type="submit" name="btn_register" style="width:100%; padding:10px; background:green; color:white; border:none;">ĐĂNG KÝ</button>
    </form>
</div>

<?php include '../core_shared/footer.php'; ?>