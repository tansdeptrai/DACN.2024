<?php
require_once 'includes/function.php';
$id_province = $_POST['id'];
$districts = getRaw("SELECT district_id, name FROM district WHERE province_id = $id_province");
// echo '<pre>';
// print_r($districts);
// echo '</pre>';
echo json_encode($districts);
