<?php 
session_start();
include '../config/database.php';

// CHẶN NGƯỜI DÙNG THƯỜNG: Nếu không phải admin, đá về trang chủ
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

include '../core_shared/header.php'; 

// 1. Xử lý xác nhận Booking
if(isset($_GET['confirm_id'])) {
    $id = intval($_GET['confirm_id']);
    mysqli_query($conn, "UPDATE bookings SET status = 'Đã xác nhận' WHERE id = $id");
    echo "<script>window.location='dashboard.php';</script>";
}

// 2. Xử lý Xóa (Booking/Dịch vụ/Địa điểm)
if(isset($_GET['del_type']) && isset($_GET['del_id'])) {
    $table = $_GET['del_type']; // bookings, services, hoặc locations
    $id = intval($_GET['del_id']);
    mysqli_query($conn, "DELETE FROM $table WHERE id = $id");
    echo "<script>window.location='dashboard.php';</script>";
}
?>

<div class="container">
    <h1 style="color: #004a99; border-left: 10px solid #ffc107; padding-left: 15px;">BẢNG ĐIỀU KHIỂN ADMIN</h1>

    <section style="margin-top: 40px;">
        <h2 style="background: #eee; padding: 10px;">1. Quản lý Đặt vé (Booking)</h2>
        <table style="width: 100%; border-collapse: collapse; background: white;">
            <tr style="background: #004a99; color: white;">
                <th style="padding: 10px;">ID</th>
                <th>Khách hàng</th>
                <th>Dịch vụ</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
            <?php
            $res = mysqli_query($conn, "SELECT bookings.*, services.name as sname FROM bookings JOIN services ON bookings.service_id = services.id ORDER BY id DESC");
            while($row = mysqli_fetch_assoc($res)):
            ?>
            <tr style="text-align: center; border-bottom: 1px solid #ddd;">
                <td style="padding: 15px;">#<?php echo $row['id']; ?></td>
                <td>User ID: <?php echo $row['user_id']; ?></td>
                <td><?php echo $row['sname']; ?></td>
                <td><?php echo $row['booking_date']; ?></td>
                <td style="font-weight:bold; color:<?php echo ($row['status']=='Đã xác nhận'?'green':'orange'); ?>"><?php echo $row['status']; ?></td>
                <td>
                    <?php if($row['status'] == 'Chờ xác nhận'): ?>
                        <a href="?confirm_id=<?php echo $row['id']; ?>" style="color:green;">[Xác nhận]</a>
                    <?php endif; ?>
                    <a href="?del_type=bookings&del_id=<?php echo $row['id']; ?>" onclick="return confirm('Xóa đơn này?')" style="color:red;">[Xóa]</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <section style="margin-top: 60px;">
        <h2 style="background: #eee; padding: 10px;">2. Quản lý Địa điểm (Locations)</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <?php
            $res_loc = mysqli_query($conn, "SELECT * FROM locations");
            while($loc = mysqli_fetch_assoc($res_loc)):
            ?>
            <div style="background: white; padding: 10px; border-radius: 8px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                <img src="../assets/images/<?php echo $loc['image']; ?>" style="width:100%; height:120px; object-fit:cover; border-radius: 5px;">
                <h4 style="margin: 10px 0;"><?php echo $loc['name']; ?></h4>
                <a href="?del_type=locations&del_id=<?php echo $loc['id']; ?>" style="color:red; font-size: 0.8rem;">Xóa địa điểm</a>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
</div>

<?php include '../core_shared/footer.php'; ?>