<?php
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$sex = $_POST['sex'];
$phone = $_POST['phone'];
$id_user = $_POST['id'];

$dataUpdate = [
    'fullname'=>$fullname,
    'email'=>$email,
    'sex'=>$sex,
    'phone'=>$phone
];
$condition = "id = $id_user";
$updateStatus = update("users", $dataUpdate, $condition);
if ($updateStatus) {
    echo "Thay đổi thông tin thành công!!!";                            
}

