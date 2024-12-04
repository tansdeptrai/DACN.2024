<?php
if ($_POST['id_product_variant']) {
    $idVp = $_POST['id_product_variant'];
    $image = oneRaw("SELECT id, image FROM variant_products WHERE id = $idVp");
    $response['image'] = [
        'image'=>$image['image'],
        'id'=>$image['id'],
    ]; 
}
header('Content-Type: application/json');
echo json_encode($response);