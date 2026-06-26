<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
include '../config/database.php';
if(($_SESSION['role'] ?? '') !== 'admin') { header("Location: ../index.php"); exit(); }
include '../core_shared/header.php'; 
?>
<div class="container">
    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 30px; text-align: center;">
        <h2 style="color: #004a99; margin: 0; text-transform: uppercase;">Trung Tâm Quản Trị Hệ Thống</h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
        <a href="manage_bookings.php" style="background: #004a99; color: white; padding: 40px 20px; text-align: center; border-radius: 15px; text-decoration: none; font-weight: bold; font-size: 1.1rem; box-shadow: 0 5px 15px rgba(0,74,153,0.2);">
            📋 QUẢN LÝ BOOKING
        </a>
        <a href="manage_locations.php" style="background: #ffc107; color: black; padding: 40px 20px; text-align: center; border-radius: 15px; text-decoration: none; font-weight: bold; font-size: 1.1rem; box-shadow: 0 5px 15px rgba(255,193,7,0.2);">
            📍 QUẢN LÝ ĐỊA ĐIỂM
        </a>
        <a href="manage_services.php" style="background: #28a745; color: white; padding: 40px 20px; text-align: center; border-radius: 15px; text-decoration: none; font-weight: bold; font-size: 1.1rem; box-shadow: 0 5px 15px rgba(40,167,69,0.2);">
            🎫 QUẢN LÝ DỊCH VỤ
        </a>
    </div>
</div>
<?php include '../core_shared/footer.php'; ?>