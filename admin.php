<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Admin</title>
</head>
<body>
<?php
include 'adminDatabase.php';
include 'uploadImage.php';
$kq = connectDB("SELECT * FROM producttest1");
if (isset($_GET['edit'])) $index=$_GET['edit'];
if (isset($_GET['del'])) {
    $delId = $_GET['del'];
    deleteDB($delId);
    header("Location: admin.php");
}
if(isset($_POST['editProduct']) && ($_POST['editProduct'])) {
    $id = $_POST['id'];
    $image = $_POST['image'];
    $name = $_POST['name'];
    $quantity = 1;
    $price = $_POST['price'];
    $hot = $_POST['hot'];
    $sale = $_POST['sale'];
    updateDB("UPDATE producttest1 SET name='$name', image='$image', price='$price',sale='$sale' WHERE id='$id'");
    header("Location: admin.php");
}
if(isset($_POST["addProduct"])&&($_POST["addProduct"])){
    $id=$_POST['id'];
    $image = uploadImage();
    $name=$_POST["name"];
    $price=$_POST["price"];
    $quantity=1;
    $hot=$_POST["hot"];
    $sale=$_POST["sale"];
    insertDB("INSERT INTO producttest1 (id,name,price,image,quantity,hot,sale) VALUES ('$id','$name','$price','$image','$quantity','$hot','$sale')");
    header("Location: admin.php");
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-6">
            <input type="text" placeholder="ID sản phẩm" class="form-control" name="id" value="<?php if(isset($index)) echo $kq[$index]['id']?>">
            <input type="text" placeholder="Tên sản phẩm" class="form-control" name="name" value="<?php if(isset($index)) echo $kq[$index]['name']?>">
            <input type="text" placeholder="Nhập đường dẫn hình ảnh" class="form-control" name="image" value="<?php if(isset($index)) echo $kq[$index]['image']?>">
            <input type="file" placeholder="Upload hình ảnh" class="form-control" name="imageToUpload">
            <input type="text" placeholder="Gía sản phẩm" class="form-control" name="price" value="<?php if(isset($index)) echo $kq[$index]['price']?>">
            <input type="text" placeholder="Số lượng" class="form-control" name="quantity" value="<?php if(isset($index)) echo $kq[$index]['quantity']?>">
            <input type="text" placeholder="Đánh giá sản phẩm hot" class="form-control" name="hot" value="<?php if(isset($index)) echo $kq[$index]['hot']?>">
            <input type="text" placeholder="Số lượng mua" class="form-control" name="sale" value="<?php if(isset($index)) echo $kq[$index]['sale']?>">
        </div>
    </div>
    <div class="row">
        <input type="submit" class="btn btn-primary" name="addProduct" value="Thêm sản phẩm">
        <input type="submit" class="btn btn-warning" name="editProduct" value="Cập nhật sản phẩm">
    </div>
</form>
<div class="card m-4">
    <div class="card-header">Quản lý sản phẩm</div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Gía</th>
                <th>Số lượng</th>
                <th>Nổi bật</th>
                <th>Đã bán</th>
                <th>Thay đổi</th>
            </tr>
            <?php
            $stt = 1;
            foreach ($kq as $index=>$item) {
                echo
                "
                    <tr>
                        <td>$stt</td>
                        <td>".$item['id']."</td>
                        <td>".$item['name']."</td>
                        <td><img src='".$item['image']."' alt='' width='200'></td>
                        <td>".$item['price']."</td>
                        <td>".$item['quantity']."</td>
                        <td>".$item['hot']."</td>
                        <td>".$item['sale']."</td>
                        <td><a href='admin.php?edit=".$index."'>Sửa</a> / <a href='admin.php?del=".$item["id"]."'>Xóa</a></td>
                    </tr>
                ";
                $stt +=1;
            }
            ?>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>