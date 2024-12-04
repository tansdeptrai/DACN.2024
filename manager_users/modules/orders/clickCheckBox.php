<?php
if (isset($_POST['id'])) {
$id = $_POST['id'];
$total = 0;
foreach ($id as $items) {
    $products = getRaw("SELECT quantity, price FROM orders WHERE id= $items");
    foreach ($products as $pro) {
        $quantity = $pro['quantity'];
        $price =  $pro['price'];
        $totalPro = $quantity * $price;
        $total += $totalPro;
    }
}
echo htmlspecialchars(number_format($total,0,',')) . "VNĐ";
}else{
    echo '0 VNĐ';
}