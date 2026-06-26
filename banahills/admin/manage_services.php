<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
include '../config/database.php';
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') { header("Location: ../index.php"); exit(); }
include '../core_shared/header.php'; 

// --- XỬ LÝ THÊM/XÓA (Có cột image) ---
if(isset($_POST['add_service'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/" . $image);
    mysqli_query($conn, "INSERT INTO services (name, description, price, image) VALUES ('$name', '$desc', '$price', '$image')");
    header("Location: manage_services.php"); exit();
}
if(isset($_GET['del_id'])) {
    $id = intval($_GET['del_id']);
    mysqli_query($conn, "DELETE FROM services WHERE id = $id");
    header("Location: manage_services.php"); exit();
}
?>

<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; background: #fff; padding: 15px 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 25px;">
        <h2 style="color: #004a99; margin: 0; border-left: 8px solid #28a745; padding-left: 15px;">QUẢN LÝ DỊCH VỤ</h2>
        <a href="index.php" style="background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 0.9rem;">&larr; QUAY LẠI DASHBOARD</a>
    </div>

    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 30px;">
        <form method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
            <div style="display: flex; gap: 15px;">
                <input type="text" name="name" placeholder="Tên dịch vụ" required style="flex:2; padding:10px; border:1px solid #ddd; border-radius:5px;">
                <input type="number" name="price" placeholder="Giá vé" required style="flex:1; padding:10px; border:1px solid #ddd; border-radius:5px;">
                <input type="file" name="image" required style="flex:1; font-size:0.8rem;">
            </div>
            <textarea name="description" placeholder="Mô tả dịch vụ chi tiết..." required style="padding:10px; height:60px; border:1px solid #ddd; border-radius:5px;"></textarea>
            <button type="submit" name="add_service" style="background:#28a745; color:white; padding:12px; border:none; border-radius:5px; cursor:pointer; font-weight:bold;">+ LƯU DỊCH VỤ</button>
        </form>
    </div>

    <table style="width:100%; background:white; border-collapse:collapse;">
        <tr style="background:#004a99; color:white;">
            <th style="padding:15px;">Ảnh</th>
            <th>Tên Dịch Vụ</th>
            <th>Mô Tả</th>
            <th>Giá Vé</th>
            <th>Thao Tác</th>
        </tr>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM services ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($res)): ?>
        <tr style="text-align:center; border-bottom:1px solid #eee;">
            <td style="padding:10px;"><img src="../assets/images/<?php echo $row['image']; ?>" width="80" style="border-radius:5px;"></td>
            <td style="font-weight:bold; color:#004a99;"><?php echo $row['name']; ?></td>
            <td style="font-size:0.85rem; color:#666; text-align:left; padding:10px;"><?php echo $row['description']; ?></td>
            <td style="color:red; font-weight:bold;"><?php echo number_format($row['price'], 0, ',', '.'); ?>đ</td>
            <td>
                <a href="edit_services.php?id=<?php echo $row['id']; ?>" style="color:blue; text-decoration:none;">[Sửa]</a>
                <a href="?del_id=<?php echo $row['id']; ?>" onclick="return confirm('Xóa?')" style="color:red; text-decoration:none; margin-left:10px;">[Xóa]</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php include '../core_shared/footer.php'; ?>