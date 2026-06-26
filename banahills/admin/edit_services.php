<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
include '../config/database.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') { header("Location: ../index.php"); exit(); }

$id = intval($_GET['id']);
$res = mysqli_query($conn, "SELECT * FROM services WHERE id = $id");
$data = mysqli_fetch_assoc($res);

if(isset($_POST['update_service'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);
    
    // Nếu chọn ảnh mới
    if(!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/" . $image);
        $sql = "UPDATE services SET name='$name', description='$description', price='$price', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE services SET name='$name', description='$description', price='$price' WHERE id=$id";
    }
    
    mysqli_query($conn, $sql);
    header("Location: manage_services.php"); exit();
}

include '../core_shared/header.php';
?>

<div class="container">
    <div style="max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
        <h2 style="color: #004a99; text-align: center;">SỬA DỊCH VỤ</h2>
        <form method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px;">
            <div>
                <label style="font-weight: bold; display: block;">Tên dịch vụ</label>
                <input type="text" name="name" value="<?php echo $data['name']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            <div>
                <label style="font-weight: bold; display: block;">Mô tả</label>
                <textarea name="description" required style="width: 100%; height: 100px; padding: 12px; border: 1px solid #ddd; border-radius: 5px;"><?php echo $data['description']; ?></textarea>
            </div>
            <div>
                <label style="font-weight: bold; display: block;">Giá vé</label>
                <input type="number" name="price" value="<?php echo $data['price']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            <div>
                <label style="font-weight: bold; display: block;">Ảnh hiện tại</label>
                <img src="../assets/images/<?php echo $data['image']; ?>" style="width: 120px; border-radius: 5px; margin: 10px 0;">
                <input type="file" name="image" style="display: block;">
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" name="update_service" style="flex: 2; background: #004a99; color: white; padding: 15px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">CẬP NHẬT</button>
                <a href="manage_services.php" style="flex: 1; background: #eee; color: #333; padding: 15px; text-align: center; text-decoration: none; border-radius: 5px;">HỦY</a>
            </div>
        </form>
    </div>
</div>

<?php include '../core_shared/footer.php'; ?>