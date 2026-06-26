<?php 
session_start();
include '../config/database.php';
include '../core_shared/header.php'; 
?>
<div class="container" style="margin-top: 20px;">
    <h2 style="color: #004a99; border-left: 8px solid #ffc107; padding-left: 15px; margin-bottom: 40px; text-transform: uppercase;">Thông tin chi tiết các địa điểm</h2>
    
    <?php
    $res = mysqli_query($conn, "SELECT * FROM locations ORDER BY id DESC");
    while($row = mysqli_fetch_assoc($res)):
    ?>
    <div id="loc-<?php echo $row['id']; ?>" 
         style="display: flex; gap: 40px; background: white; padding: 35px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 50px; align-items: center; scroll-margin-top: 100px;">
        
        <div style="flex: 1;">
            <img src="/banahills/assets/images/<?php echo $row['image']; ?>" 
                 style="width: 100%; height: 350px; object-fit: cover; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        </div>

        <div style="flex: 1.5;">
            <h3 style="color: #004a99; font-size: 2.2rem; margin: 0 0 20px 0; font-weight: 800;"><?php echo $row['name']; ?></h3>
            <p style="line-height: 1.8; color: #444; font-size: 1.1rem; text-align: justify; margin-bottom: 25px;">
                <?php echo $row['description']; ?>
            </p>
            <a href="services.php" style="background: #004a99; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;">ĐẶT VÉ THAM QUAN &rarr;</a>
        </div>
    </div>
    <?php endwhile; ?>
</div>
<?php include '../core_shared/footer.php'; ?>