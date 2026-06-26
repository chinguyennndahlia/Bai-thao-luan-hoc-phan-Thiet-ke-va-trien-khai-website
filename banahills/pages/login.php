<?php 
session_start(); 
include '../config/database.php';
include '../core_shared/header.php';

if (isset($_POST['btn_login'])) {
    $u = mysqli_real_escape_string($conn, $_POST['user']);
    $p = mysqli_real_escape_string($conn, $_POST['pass']);

    // So sánh trực tiếp bằng dấu = trong câu lệnh SQL
    $sql = "SELECT * FROM users WHERE username = '$u' AND password = '$p'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        echo "<script>alert('Đăng nhập thành công!'); window.location.href='../index.php';</script>";
    } else {
        // Đã xóa phần hiện tên/mk để bảo mật theo yêu cầu của bạn
        echo "<script>alert('Sai tài khoản hoặc mật khẩu!'); window.location.href='login.php';</script>";
    }
}
?>

<div style="width: 350px; margin: 80px auto; border: 1px solid #ddd; padding: 20px;">
    <h2>ĐĂNG NHẬP</h2>
    <form method="POST">
        User: <input type="text" name="user" required style="width:100%"><br><br>
        Pass: <input type="password" name="pass" required style="width:100%"><br><br>
        <button type="submit" name="btn_login" style="width:100%; padding:10px; background:#004a99; color:white; border:none;">VÀO HỆ THỐNG</button>
    </form>
</div>

<?php include '../core_shared/footer.php'; ?>