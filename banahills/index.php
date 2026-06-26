<?php 
session_start();
include 'config/database.php';
include 'core_shared/header.php'; 
?>
<div class="hero">
    <h1 style="font-size: 3.5rem; margin:0;">BÀ NÀ HILLS</h1>
    <p>Đường lên tiên cảnh - Trải nghiệm đẳng cấp</p>
</div>

<div class="container">
    <h2 style="text-align: center; color: #004a99; margin: 40px 0; letter-spacing: 1px;">ĐIỂM ĐẾN NỔI BẬT</h2>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
        <?php
        $res = mysqli_query($conn, "SELECT * FROM locations ORDER BY id DESC LIMIT 2");
        while($row = mysqli_fetch_assoc($res)):
        ?>
        <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <img src="/banahills/assets/images/<?php echo $row['image']; ?>" style="width: 100%; height: 220px; object-fit: cover;">
            <div style="padding: 20px; text-align: center;">
                <h3 style="color: #004a99; margin-bottom: 10px;"><?php echo $row['name']; ?></h3>
                <p style="color: #666; font-size: 0.9rem; line-height: 1.5; height: 4.5em; overflow: hidden;">
                    <?php echo mb_substr($row['description'], 0, 90, 'utf-8'); ?>...
                </p>
                <a href="/banahills/pages/locations.php#loc-<?php echo $row['id']; ?>" 
                   style="color: #004a99; font-weight: bold; text-decoration: none; font-size: 0.85rem; border-bottom: 2px solid #004a99;">
                   XEM CHI TIẾT ĐỊA ĐIỂM
                </a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <div style="text-align: center; margin-top: 50px;">
        <a href="/banahills/pages/locations.php" style="padding: 15px 40px; background: #004a99; color: white; text-decoration: none; border-radius: 30px; font-weight: bold; box-shadow: 0 4px 15px rgba(0,74,153,0.3);">KHÁM PHÁ TẤT CẢ ĐỊA ĐIỂM</a>
    </div>
</div>
<?php include 'core_shared/footer.php'; ?>