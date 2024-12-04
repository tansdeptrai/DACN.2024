
<?php 
$code_cart = $_POST['code_carts'];
$status = $_POST['status'];


$dataUpdate = [
    'status'=>$status,
];
$condition = "code_carts = '$code_cart'";
$updateStatus = update("carts", $dataUpdate, $condition);
if ($updateStatus) {
    echo "Thay đổi thành công";
}else {
    echo "Thay đổi trạng thái thất bại!!";
}