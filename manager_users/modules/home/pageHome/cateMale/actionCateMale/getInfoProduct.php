<?php
$id = $_POST['id'];          //id product
$idColor = $_POST['idColor'];
$nameColor = oneRaw("SELECT id, name_color FROM colors WHERE id = $idColor ");
$product = oneRaw("SELECT id, name, image, cate_id, code_pro FROM products WHERE id = $id");
$variantProduct = getRaw("SELECT size_id, quantity, price, image, color_id FROM variant_products WHERE product_id = $id");        // lấy id size 

$response = [];
if ($product) {
    $response['products'] = [
        'id' =>  $product['id'],
        'name' => $product['name'],
        'image' => $product['image'],
        'name_color'=>$nameColor['name_color'],
        'code_pro'=>$product['code_pro'],
       ];
    $idSizes = [];
    $nS = [];
    if ($variantProduct) {
        foreach ($variantProduct as $idSize) {
            //mảng chứa id_size, price, quantity
            $price =  number_format($idSize['price'], 0, ',', '.');
            $idColorChanger = $idSize['color_id'];
            $nColor = oneRaw("SELECT id, name_color FROM colors WHERE id = $idColorChanger ");
            $idSizes[] = [
                'idSize'=> $idSize['size_id'],
                'quantity'=> $idSize['quantity'],
                'price'=> $price,
                'image'=>$idSize['image'],
                'idColor'=>$nColor['name_color'],
            ];
            $id_sizes = $idSize['size_id'];             //id size để truy xuất tên size trong bảng sizes
            $nameSizes = getRaw("SELECT id, name_size FROM sizes WHERE id = $id_sizes");   // lấy name size
            foreach ($nameSizes as $nameSize) {
                //mảng chứa namesize
                $nS[] = [
                    'name_size' => $nameSize['name_size'],
                    'id_size'=>$nameSize['id'],
                ];
            }
        }
    }
    //update lại idSize và nameSize vào $response thành mảng kết hợp để gửi về 
    // $response['idSizes'] = $idSizes;
    $response['nameSizes'] = $nS;
    $response['changer'] = $idSizes;
}
header('Content-Type: application/json');
echo json_encode($response);
