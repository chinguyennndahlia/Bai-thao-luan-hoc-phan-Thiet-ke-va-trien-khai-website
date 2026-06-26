<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
include '../config/database.php';
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') { header("Location: ../index.php"); exit(); }
include '../core_shared/header.php'; 

// --- XỬ LÝ THÊM/XÓA (Giữ nguyên logic cũ) ---
if(isset($_POST['add_loc'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/" . $image);
    mysqli_query($conn, "INSERT INTO locations (name, description, image) VALUES ('$name', '$description', '$image')");
    header("Location: manage_locations.php"); exit();
}
if(isset($_GET['del_id'])) {
    $id = intval($_GET['del_id']);
    mysqli_query($conn, "DELETE FROM locations WHERE id = $id");
    header("Location: manage_locations.php"); exit();
}
?>

<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; background: #fff; padding: 15px 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 25px;">
        <h2 style="color: #004a99; margin: 0; border-left: 8px solid #ffc107; padding-left: 15px;">QUẢN LÝ ĐỊA ĐIỂM</h2>
        <a href="index.php" style="background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 0.9rem;">&larr; QUAY LẠI DASHBOARD</a>
    </div>

    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 30px;">
        <form method="POST" enctype="multipart/form-data" style="display: flex; gap: 15px; align-items: flex-end;">
            <div style="flex: 1;">
                <label style="font-weight:bold; font-size:0.8rem;">Tên địa điểm</label>
                <input type="text" name="name" required style="width:100%; padding: 10px; border:1px solid #ddd; border-radius:5px;">
            </div>
            <div style="flex: 2;">
                <label style="font-weight:bold; font-size:0.8rem;">Mô tả ngắn</label>
                <input type="text" name="description" required style="width:100%; padding: 10px; border:1px solid #ddd; border-radius:5px;">
            </div>
            <div style="flex: 1;">
                <label style="font-weight:bold; font-size:0.8rem;">Hình ảnh</label>
                <input type="file" name="image" required style="width:100%; font-size:0.8rem;">
            </div>
            <button type="submit" name="add_loc" style="background:#28a745; color:white; padding:11px 20px; border:none; border-radius:5px; cursor:pointer; font-weight:bold;">+ LƯU</button>
        </form>
    </div>

    <table style="width:100%; background:white; border-collapse:collapse;">
        <tr style="background:#004a99; color:white;">
            <th style="padding:15px;">Ảnh</th>
            <th>Tên</th>
            <th>Mô tả</th>
            <th>Thao tác</th>
        </tr>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM locations ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($res)): ?>
        <tr style="text-align:center; border-bottom:1px solid #eee;">
            <td style="padding:10px;"><img src="../assets/images/<?php echo $row['image']; ?>" width="80" style="border-radius:5px;"></td>
            <td style="font-weight:bold;"><?php echo $row['name']; ?></td>
            <td style="font-size:0.85rem; color:#666; text-align:left;"><?php echo $row['description']; ?></td>
            <td>
                <a href="edit_locations.php?id=<?php echo $row['id']; ?>" style="color:blue; text-decoration:none;">[Sửa]</a>
                <a href="?del_id=<?php echo $row['id']; ?>" onclick="return confirm('Xóa?')" style="color:red; text-decoration:none; margin-left:10px;">[Xóa]</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php include '../core_shared/footer.php'; ?>