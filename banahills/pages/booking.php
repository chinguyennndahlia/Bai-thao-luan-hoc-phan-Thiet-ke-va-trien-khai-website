<?php 
session_start();
include '../config/database.php';
include '../core_shared/header.php'; 

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    die("<div class='container'><h2>Vui lòng đăng nhập để đặt vé!</h2></div>");
}

$service_id = intval($_GET['service_id'] ?? 0);
$date = date('Y-m-d');

if ($service_id > 0) {
    $sql = "INSERT INTO bookings (user_id, service_id, booking_date, status) VALUES ('$user_id', '$service_id', '$date', 'Chờ xác nhận')";
    if (mysqli_query($conn, $sql)) {
        echo "<div class='container' style='text-align:center;'>
                <h1 style='color:green;'>✔ ĐẶT VÉ THÀNH CÔNG!</h1>
                <p>Nhân viên sẽ liên hệ xác nhận và bạn sẽ thanh toán tại quầy.</p>
                <a href='../index.php' class='btn-cta'>VỀ TRANG CHỦ</a>
              </div>";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
include '../core_shared/footer.php';
?><?php 
session_start();
include '../config/database.php';
include '../core_shared/header.php'; 

// 1. Kiểm tra đăng nhập (Bắt buộc phải có user_id)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
    echo "<div class='container' style='text-align:center; padding:50px;'>
            <h2>Vui lòng đăng nhập để đặt vé!</h2>
            <a href='login.php' class='btn-order'>Đăng nhập ngay</a>
          </div>";
    include '../core_shared/footer.php';
    exit();
}

// 2. Lấy dữ liệu từ trang Services gửi sang
$service_id = isset($_GET['service_id']) ? intval($_GET['service_id']) : 0;
$booking_date = date('Y-m-d');
$status = "Chờ xác nhận"; // Trạng thái mặc định

$is_success = false;

if ($service_id > 0) {
    // 3. Thực hiện lưu thẳng vào bảng bookings của bạn
    $sql = "INSERT INTO bookings (user_id, service_id, booking_date, status) 
            VALUES ('$user_id', '$service_id', '$booking_date', '$status')";
    
    if (mysqli_query($conn, $sql)) {
        $booking_id = mysqli_insert_id($conn);
        $is_success = true;
    } else {
        $error_db = mysqli_error($conn);
    }
}
?>

<div class="container">
    <div style="max-width: 600px; margin: 50px auto; text-align: center; background: white; padding: 50px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        
        <?php if($is_success): ?>
            <div style="color: #28a745; font-size: 5rem; margin-bottom: 20px;">✔</div>
            <h1 style="color: #004a99;">ĐẶT VÉ THÀNH CÔNG!</h1>
            <p style="font-size: 1.1rem; color: #666;">
                Yêu cầu của bạn đã được hệ thống ghi nhận. <br>
                Mã đơn hàng: <strong>#BNH-<?php echo $booking_id; ?></strong>
            </p>
            <div style="background: #fff9e6; padding: 15px; border-radius: 10px; margin: 20px 0; border: 1px dashed #ffc107;">
                <p style="margin: 0; color: #856404;">
                    <b>Trạng thái:</b> <?php echo $status; ?><br>
                    Quý khách có thể thanh toán trực tiếp tại quầy vé.
                </p>
            </div>
            <a href="../index.php" class="btn-cta" style="display: block; text-decoration: none;">VỀ TRANG CHỦ</a>

        <?php else: ?>
            <div style="color: #dc3545; font-size: 5rem; margin-bottom: 20px;">X</div>
            <h1 style="color: #d32f2f;">LỖI ĐẶT VÉ</h1>
            <p>Không thể gửi yêu cầu đặt vé. Vui lòng thử lại.</p>
            <?php if(isset($error_db)) echo "<p style='color:red; font-size:0.8rem;'>Lỗi: $error_db</p>"; ?>
            <a href="services.php" class="btn-order" style="display: inline-block; margin-top: 20px;">THỬ LẠI</a>
        <?php endif; ?>

    </div>
</div>

<?php include '../core_shared/footer.php'; ?>