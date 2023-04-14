<?php session_start() ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Cart</title>
</head>
<body>
<table>
    <tr>
        <th class="col-2">Tên sản phẩm</th>
        <th class="col-3">Hình ảnh</th>
        <th class="col-3">Số lượng</th>
        <th class="col-3">Gía tiền</th>
    </tr>
    <?php if (isset($_SESSION['cart'])) foreach ($_SESSION['cart'] as $index=>$item) { ?>
        <tr>
            <td><?php echo $item['name']?></td>
            <td><img src="<?php echo $item['image']?>" alt="" class="card-img"></td>
            <td>
                <button><a href="cart.php?decrease=<?=$index?>">-</a></button>
                <?php echo $item['quantity'] ?>
                <button><a href="cart.php?increase=<?=$index?>">+</a></button>
            </td>
            <td><?php echo $item['price'] ?></td>
            <td>
                <button><a href="cart.php?remove=<?=$index?>">Xóa</a></button>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="3">Tổng tiền:</td>
        <td colspan="2">
            <?php
            $tongtien = 0;
            foreach ($_SESSION['cart'] as $item) {
                $tongtien += $item['price'] *$item['quantity'];
            }
            echo $tongtien;
            ?>
        </td>
    </tr>
</table>
<a href="cart.php?remove=all">Xóa giỏ hàng</a>
<?php
if(isset($_GET['remove'])) {
    if($_GET['remove'] == 'all') {
        unset($_SESSION['cart']);
        header("Location: menus.php");
    } else {
        $index = $_GET['remove'];
        unset($_SESSION['cart'][$index]);
        header("Location: cart.php");
    }
}
if(isset($_GET['increase'])){
    $index=$_GET['increase'];
    $_SESSION['cart'][$index]['quantity']+=1;
    header("Location: cart.php");
}
if(isset($_GET['decrease'])){
    $index=$_GET['decrease'];
    $_SESSION['cart'][$index]['quantity']-=1;
    header("Location: cart.php");
}
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>