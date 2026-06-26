<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Nếu không phải admin, đá về trang login hoặc báo lỗi
    die("Bạn không có quyền truy cập trang này!");
}
?>

$data = $conn->query("SELECT * FROM users");
?>

<h2>User</h2>

<?php foreach($data as $u): ?>
    <p><?= $u['name'] ?> - <?= $u['email'] ?></p>
<?php endforeach; ?>