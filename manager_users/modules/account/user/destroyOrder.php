<?php
 $code_carts = $_POST['code_carts'];
//  echo $code_carts;
$dataUpdate = [
    'status' => '5',
];
$condition = "code_carts = '$code_carts'";
$carts = getRaw("SELECT status FROM carts WHERE $condition");
$status = '';
foreach ($carts as $cart) {
    foreach ($cart as $c) {
        $status = $c;
        break;
    }
}
if ($dataUpdate['status'] == $status) {
    echo "Đơn Hàng Của Bạn Đã Được Hủy !!!";
}else{
    $updateStatus = update("carts", $dataUpdate, $condition );
    if ($updateStatus) {
        echo "Hủy Đơn Hàng Thành Công!!";
    } 
}

?>