<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
include '../config/database.php';
if(($_SESSION['role'] ?? '') !== 'admin') { header("Location: ../index.php"); exit(); }

// Xử lý nút Xác nhận/Xóa
if(isset($_GET['confirm_id'])) {
    mysqli_query($conn, "UPDATE bookings SET status = 'Đã xác nhận' WHERE id = ".intval($_GET['confirm_id']));
    header("Location: manage_bookings.php"); exit();
}
if(isset($_GET['del_id'])) {
    mysqli_query($conn, "DELETE FROM bookings WHERE id = ".intval($_GET['del_id']));
    header("Location: manage_bookings.php"); exit();
}

include '../core_shared/header.php'; 
?>
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2 style="color: #004a99; border-left: 8px solid #004a99; padding-left: 15px; margin: 0;">CHI TIẾT ĐẶT VÉ</h2>
        <a href="index.php" style="background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">&larr; VỀ DASHBOARD</a>
    </div>

    <table>
        <tr style="background: #004a99; color: white;">
            <th style="padding: 15px;">Mã Đơn</th>
            <th>Dịch Vụ</th>
            <th>Trạng Thái</th>
            <th>Thao Tác</th>
        </tr>
        <?php
        $res = mysqli_query($conn, "SELECT bookings.*, services.name as sname FROM bookings JOIN services ON bookings.service_id = services.id ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($res)): 
            $stt = $row['status'];
            $color = ($stt == 'Đã xác nhận') ? '#28a745' : '#ff9800';
        ?>
        <tr style="text-align: center;">
            <td style="padding: 15px; font-weight: bold;">#<?php echo $row['id']; ?></td>
            <td style="font-weight: bold; color: #004a99;"><?php echo $row['sname']; ?></td>
            <td style="color: <?php echo $color; ?>; font-weight: bold;"><?php echo $stt; ?></td>
            <td>
                <?php if($stt != 'Đã xác nhận'): ?>
                    <a href="?confirm_id=<?php echo $row['id']; ?>" style="color: green; text-decoration: none; font-weight: bold;">[Xác nhận]</a>
                <?php endif; ?>
                <a href="?del_id=<?php echo $row['id']; ?>" onclick="return confirm('Xóa?')" style="color: red; text-decoration: none; font-weight: bold; margin-left: 10px;">[Xóa]</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php include '../core_shared/footer.php'; ?>