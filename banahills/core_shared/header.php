<?php 
if (session_status() === PHP_SESSION_NONE) session_start(); 
// Tự động kết nối database để các trang con không cần gọi lại
include_once __DIR__ . '/../config/database.php';

// Kiểm tra xem đang đứng ở trang Admin hay trang Khách
$current_uri = $_SERVER['PHP_SELF'];
$is_admin_area = (strpos($current_uri, '/admin/') !== false);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Bà Nà Hills - Sun World</title>
    <style>
        /* CSS CĂN BẢN - GIỮ NGUYÊN PHONG CÁCH BÁC THÍCH */
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; background-color: #f4f7f6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px 5%; }
        
        /* GIAO DIỆN NAV NGƯỜI DÙNG (MÀU XANH) */
        nav.guest-nav { background: #004a99; padding: 15px 8%; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 999; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .guest-nav a { color: white; text-decoration: none; font-weight: bold; margin-left: 20px; transition: 0.3s; }
        .guest-nav a:hover { color: #ffc107; }
        .btn-reg { background: #ffc107; color: black !important; padding: 6px 15px; border-radius: 4px; }

        /* GIAO DIỆN NAV ADMIN (MÀU ĐEN TỐI GIẢN - GIỮ NGUYÊN BẢN FIX) */
        nav.admin-nav-top { background: #222; padding: 10px 8%; display: flex; justify-content: space-between; align-items: center; color: white; border-bottom: 2px solid #ffc107; }
        .admin-nav-top a { color: #ffc107; text-decoration: none; font-weight: bold; font-size: 0.9rem; }

        /* CSS CHO BANNER TRANG CHỦ */
        .hero { 
            width: 100%; height: 50vh; 
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('/banahills/assets/images/banner.jpg') no-repeat center/cover;
            display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-align: center;
        }
        
        /* TABLE CHUẨN CHO CÁC TRANG QUẢN TRỊ VÀ DỊCH VỤ */
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th { background: #004a99; color: white; padding: 15px; }
        td { padding: 12px; border-bottom: 1px solid #eee; text-align: center; }
    </style>
</head>
<body>

<?php if (!$is_admin_area): ?>
    <nav class="guest-nav">
        <div class="nav-links">
            <a href="/banahills/index.php" style="color: #ffc107; margin-left:0; font-size: 1.2rem; letter-spacing: 1px;">BÀ NÀ HILLS</a>
            <a href="/banahills/pages/locations.php">ĐỊA ĐIỂM</a>
            <a href="/banahills/pages/services.php">DỊCH VỤ</a>
        </div>

        <div class="auth-links">
            <?php if(isset($_SESSION['username'])): ?>
                <span style="color: white; margin-right: 10px;">Chào, <b><?php echo $_SESSION['username']; ?></b></span>
                
                <a href="/banahills/pages/my_bookings.php" style="color: #ffc107; border: 1px solid #ffc107; padding: 4px 10px; border-radius: 4px; font-size: 0.85rem;">ĐƠN HÀNG</a>
                
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <a href="/banahills/admin/index.php" style="background:#ffc107; color:black; padding:5px 12px; border-radius:4px;">QUẢN TRỊ</a>
                <?php endif; ?>
                
                <a href="/banahills/pages/logout.php" style="color: #ff4d4d;">Thoát</a>
            <?php else: ?>
                <a href="/banahills/pages/login.php">Đăng nhập</a>
                <a href="/banahills/pages/register.php" class="btn-reg">Đăng ký</a>
            <?php endif; ?>
        </div>
    </nav>
<?php else: ?>
    <nav class="admin-nav-top">
        <div style="font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Hệ Thống Quản Trị Nội Bộ</div>
        <div>
            <span style="font-size: 0.85rem; color: #ccc;">Quyền hạn: </span>
            <b style="color: #ffc107;">ADMINISTRATOR</b>
            <a href="/banahills/pages/logout.php" style="margin-left: 25px; color: #ff4d4d; border: 1px solid #ff4d4d; padding: 3px 10px; border-radius: 3px;">Đăng xuất</a>
        </div>
    </nav>
<?php endif; ?>