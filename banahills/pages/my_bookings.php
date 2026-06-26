<?php 
session_start();
include '../config/database.php';

// Bảo mật: Nếu chưa đăng nhập thì đá về trang login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../core_shared/header.php'; 
$user_id = $_SESSION['user_id'];
?>

<div class="container" style="margin-top: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="color: #004a99; border-left: 8px solid #ffc107; padding-left: 15px; margin: 0;">LỊCH SỬ ĐẶT VÉ CỦA TÔI</h2>
        <a href="services.php" style="background: #004a99; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 0.9rem;">+ ĐẶT VÉ MỚI</a>
    </div>

    <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; border-bottom: 2px solid #eee;">
                    <th style="padding: 20px; text-align: center; width: 100px;">Mã Đơn</th>
                    <th style="padding: 20px; text-align: left;">Dịch Vụ Đã Đặt</th>
                    <th style="padding: 20px; text-align: center;">Ngày Đặt</th>
                    <th style="padding: 20px; text-align: center;">Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Chỉ lấy đơn hàng của chính người đang đăng nhập
                $sql = "SELECT bookings.*, services.name as sname, services.image as simg 
                        FROM bookings 
                        JOIN services ON bookings.service_id = services.id 
                        WHERE bookings.user_id = $user_id 
                        ORDER BY bookings.id DESC";
                
                $res = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($res) > 0):
                    while ($row = mysqli_fetch_assoc($res)):
                        $status = $row['status'];
                        // Đổi màu chữ theo trạng thái
                        $color = ($status == 'Đã xác nhận') ? '#28a745' : '#ff9800';
                        $bg_light = ($status == 'Đã xác nhận') ? '#e8f5e9' : '#fff3e0';
                ?>
                <tr style="border-bottom: 1px solid #f1f1f1;">
                    <td style="padding: 20px; text-align: center; font-weight: bold; color: #666;">
                        #<?php echo $row['id']; ?>
                    </td>
                    <td style="padding: 20px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <img src="/banahills/assets/images/<?php echo $row['simg']; ?>" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                            <span style="font-weight: bold; color: #004a99;"><?php echo $row['sname']; ?></span>
                        </div>
                    </td>
                    <td style="padding: 20px; text-align: center; color: #666;">
                        <?php echo date('d/m/Y', strtotime($row['booking_date'])); ?>
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        <span style="background: <?php echo $bg_light; ?>; color: <?php echo $color; ?>; padding: 6px 12px; border-radius: 20px; font-weight: bold; font-size: 0.85rem;">
                            <?php echo $status; ?>
                        </span>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                else:
                ?>
                <tr>
                    <td colspan="4" style="padding: 50px; text-align: center; color: #999;">
                        Bác chưa có đơn đặt vé nào. <a href="services.php" style="color: #004a99; font-weight: bold;">Đặt ngay!</a>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <p style="margin-top: 20px; color: #777; font-size: 0.9rem; font-style: italic;">
        * Lưu ý: Nếu đơn hàng ở trạng thái "Chờ xác nhận", vui lòng đợi Admin kiểm tra trong ít phút.
    </p>
</div>

<?php include '../core_shared/footer.php'; ?>