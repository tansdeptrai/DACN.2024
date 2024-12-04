<?php
$quantity_vp = $_POST['quantity'];
$color_name = $_POST['color_name'];
$size_name = $_POST['size_name'];
$id_product_variant = $_POST['id_product_variant'];
$price = $_POST['price_vp'];
$code_pro = $_POST['code_pro'];
$img = $_POST['image_vp'];
$name_product = $_POST['name_product'];
$idUser = $_POST['idUser'];
$price_vp = str_replace(".", "", $price);
$response = [];
if ($quantity_vp && $color_name && $size_name && $id_product_variant && $idUser) {
    $dataInsert = [
        'id_user'=>$idUser,
        'id_product_variant'=>$id_product_variant,
        'product_name'=>$name_product,
        'image'=>$img,
        'price'=>$price_vp,
        'quantity'=>$quantity_vp,
        'code_pro'=>$code_pro,
        'color_name'=>$color_name,
        'size_name'=>$size_name,
        'create_at'=> date('Y-m-d'),
        'update_at'=> date('Y-m-d'),
    ];
    $listOder = getRaw("SELECT id, id_product_variant, id_user, product_name, image, price, code_pro, color_name, size_name FROM orders");
    $check = false;
    $idOrder = '';
        foreach ($listOder as $orders) {
            if ($dataInsert['id_user'] == $orders['id_user'] 
                        && $dataInsert['product_name'] == $orders['product_name']
                        && $dataInsert['id_product_variant'] == $orders['id_product_variant'] 
                        && $dataInsert['image'] == $orders['image']
                        && $dataInsert['price'] == $orders['price']
                        && $dataInsert['code_pro'] == $orders['code_pro']
                        && $dataInsert['color_name'] == $orders['color_name']
                        && $dataInsert['size_name'] == $orders['size_name'] ) {
                        $idOrder = $orders['id'];
                        $check = true;
                        break;
                    }
                }
    if ($check) {
        $oneOrder = oneRaw("SELECT quantity FROM orders WHERE id = $idOrder");
        $quantity = $oneOrder['quantity'];
        $dataUpdate = [
            'quantity' => ($quantity + $quantity_vp),
        ];
        $condition = "id = $idOrder"; 
        $updateStatus = update('orders', $dataUpdate, $condition);
        if ($updateStatus) {
            $response['success'] = 'Thêm vào giỏ hàng thành công!!';
        }else {
            $response['error'] = 'Không thành công vui lòng thử lại!!';
        }
        }else{
            $insertStatus = insert('orders', $dataInsert);
            if ($insertStatus) {
                $response['success'] = 'Thêm vào giỏ hàng thành công!!';
            }else {
                $response['error'] = 'Không thành công vui lòng thử lại!!';
                
            }
        }
}else {
    $response['login'] = 'Đăng nhập để thêm vào giỏ hàng!!!'; 
}
header('Content-Type: application/json');
echo json_encode($response);