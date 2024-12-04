<?php
require_once 'includes/function.php';
if (!isset($_SESSION['carts'])) {
    $_SESSION['carts'] = [];
}
$id_product = $_POST['products'];
$idKey = [];
foreach ($id_product as $ids) {
    $idKey[$ids['id']] = $ids['id'];
}
$_SESSION['carts'] = $idKey;
print_r($_SESSION['carts']); 

//

