<?php 
session_start();
include '../config/database.php';
include '../core_shared/header.php'; 
?>
<div class="container">
    <h2 style="text-align: center; color: #004a99; margin: 40px 0; text-transform: uppercase; letter-spacing: 1px;">Bảng Giá Dịch Vụ & Vé Tham Quan</h2>
    
    <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
        <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
            <thead>
                <tr style="background: #004a99; color: white;">
                    <th style="padding: 20px; width: 150px;">Ảnh</th>
                    <th style="padding: 20px; text-align: left;">Tên Dịch Vụ / Mô Tả</th>
                    <th style="padding: 20px; width: 180px;">Giá Vé</th>
                    <th style="padding: 20px; width: 180px;">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM services ORDER BY price ASC");
                while($row = mysqli_fetch_assoc($res)):
                ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 20px;">
                        <img src="/banahills/assets/images/<?php echo $row['image']; ?>" style="width: 120px; height: 80px; object-fit: cover; border-radius: 8px;">
                    </td>
                    <td style="padding: 20px;">
                        <div style="font-weight: bold; color: #004a99; font-size: 1.2rem;"><?php echo $row['name']; ?></div>
                        <div style="color: #666; font-size: 0.9rem; margin-top: 5px; line-height: 1.4;"><?php echo $row['description']; ?></div>
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        <span style="color: #d32f2f; font-weight: bold; font-size: 1.3rem;"><?php echo number_format($row['price'], 0, ',', '.'); ?>đ</span>
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="booking.php?service_id=<?php echo $row['id']; ?>" style="background: #28a745; color: white; padding: 10px 22px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">ĐẶT NGAY</a>
                        <?php else: ?>
                            <a href="login.php" style="background: #6c757d; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; font-size: 0.8rem;">Đăng nhập để đặt</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../core_shared/footer.php'; ?>