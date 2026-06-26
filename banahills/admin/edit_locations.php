<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
include '../config/database.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') { header("Location: ../index.php"); exit(); }

$id = intval($_GET['id']);
$res = mysqli_query($conn, "SELECT * FROM locations WHERE id = $id");
$data = mysqli_fetch_assoc($res);

if(isset($_POST['update_loc'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    
    // Nếu có upload ảnh mới
    if(!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/" . $image);
        mysqli_query($conn, "UPDATE locations SET name='$name', description='$desc', image='$image' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE locations SET name='$name', description='$desc' WHERE id=$id");
    }
    header("Location: manage_locations.php"); exit();
}

include '../core_shared/header.php';
?>

<div class="container">
    <div style="max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
        <h2 style="color: #004a99; text-align: center; margin-bottom: 30px;">CẬP NHẬT ĐỊA ĐIỂM</h2>
        <form method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px;">
            <div>
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Tên địa điểm</label>
                <input type="text" name="name" value="<?php echo $data['name']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
            </div>
            <div>
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Mô tả</label>
                <textarea name="description" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; height: 100px; box-sizing: border-box;"><?php echo $data['description']; ?></textarea>
            </div>
            <div>
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Ảnh hiện tại</label>
                <img src="../assets/images/<?php echo $data['image']; ?>" style="width: 150px; border-radius: 5px; margin-bottom: 10px;">
                <input type="file" name="image" style="display: block; font-size: 0.9rem;">
                <small style="color: #888;">(Bỏ trống nếu muốn giữ nguyên ảnh cũ)</small>
            </div>
            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit" name="update_loc" style="flex: 2; background: #004a99; color: white; padding: 13px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">LƯU THAY ĐỔI</button>
                <a href="manage_locations.php" style="flex: 1; background: #eee; color: #333; padding: 13px; text-align: center; text-decoration: none; border-radius: 5px; font-weight: bold;">HỦY</a>
            </div>
        </form>
    </div>
</div>

<?php include '../core_shared/footer.php'; ?>