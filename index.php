<?php session_start()?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Index</title>
</head>
<body>
<a href="cart.php"><button><img src="image/shopping-cart-svg-png-icon-download-28.png" alt="" width="50" height="50"></button></a>
<?php
    if (isset($_SESSION['cart'])) {
        $count = 0;
        foreach ($_SESSION['cart'] as $p) {
            $count+=$p['quantity'];
        }
        echo $count;
    }
?>
<div style="float: right">
    <a href="login.php" target="_blank"><button><img src="image/501-5010656_my-account-comments-my-account-icon-vector.png" alt="" width="50" height="50"></button></a>
</div>
<div style="float: right">
    <a href="admin.php" target="_blank"><button><img src="image/admin-3d-illustration-icon-png.webp" alt="" width="50" height="50"></button></a>
</div>
<?php
include 'database.php';
$products = connectDB();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
/*
$products = array(
    array('id'=> '1','name'=>'Nemo' ,'image'=>'image/nemo.jpg','price'=>'100','quantity'=>1),
    array('id'=> '2','name'=>'Dory' ,'image'=>'image/dory.jpg','price'=>'200','quantity'=>1)
);
*/
?>
<div class="row">
<?php
foreach ($products as $index=>$product) {
    echo
        '<div class="col-4">
            <form action="" method="post">
                <img src="'.$product['image'].'" alt="" class="card-img">
                <p>'.$product['name'].'</p>
                <p>'.$product['price'].'</p>              
                <input type="hidden" name="id" value="'.$product['id'].'">
                <input type="hidden" name="index" value="'.$index.'">
                <input type="submit" name="dathang">
            </form>              
        </div>';
}
?>
</div>
<?php
if (isset($_POST['dathang']) && $_POST['dathang']) {
    $check = true;
    $id = $_POST['id'];
    $index = $_POST['index'];
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $key=>$item) {
            if ($item['id'] == $id) {
                $_SESSION['cart'][$key]['quantity'] += 1;
                $check = false;
            }
        }
    }
    if($check == true) {
        array_push($_SESSION['cart'], $products[$index]);
    }
    header("Refresh:0");
}
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>