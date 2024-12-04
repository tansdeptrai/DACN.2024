<?php
// session_start();
require_once 'includes/function.php';
if(!isset($_SESSION['orders']) && !isset($_SESSION['price'])) {
    $_SESSION['orders'] = [];
    $_SESSION['price'] = [];
}
$id = $_POST['id_pro'];
$quantity = $_POST['soluong'];
$price = $_POST['prices'];

$data = [
    'id'=>$id, 
    'quantity'=>$quantity,
    'price'=>$price

];
$exists = false;
if (!empty($_SESSION['orders'])) {
    foreach ($_SESSION['orders'] as &$order) {
        if ($order['id'] == $data['id']) {
            // Nếu trùng ID, tăng quantity
            $order['quantity'] = $order['quantity'] + 1;
            $exists = true;
            break; // Dừng vòng lặp sau khi tìm thấy
        }
    }
}
if (!$exists) {
    $_SESSION['orders'][] = $data;
}
//
$total = 0;
foreach ($price as $items) {
    $totalProduct = $items['price'] * $items['quantity'];
    $total += $totalProduct;
}
//
foreach ($_SESSION['orders'] as $items) {
    $dataUpdate = [
        'id'=>$items['id'],
        'quantity'=>$items['quantity']
    ];
    $id = $items['id'];
    $condition = "id = $id";
    $updateStatus = update("orders" , $dataUpdate, $condition);
    unset($_SESSION['orders']);
    break;
}
//


echo htmlspecialchars(number_format($total,0,',')) . "VNĐ";



