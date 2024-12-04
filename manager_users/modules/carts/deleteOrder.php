<?php
// session_start();
require_once 'includes/function.php';
if(!isset($_SESSION['orders'])) {
    $_SESSION['orders'] = [];
}
$id = $_POST['id_pro'];
$deleteOrder = delete('orders', "id=$id");
if ($deleteOrder) {
     unset($_SESSION['orders']);
}




