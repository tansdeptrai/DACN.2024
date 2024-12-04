<?php
require_once 'includes/function.php';
$id_district = $_POST['id'];
$wards = getRaw("SELECT wards_id, name FROM wards WHERE district_id = $id_district");
echo json_encode($wards);