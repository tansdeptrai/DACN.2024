<?php
if (!isLogin()) {
    echo "?module=auth&action=login";
}
$id_size = $_POST['id_size'];
$id_color = $_POST['id_color'];
$name_product = $_POST['name_product'];
$img = $_POST['img'];
$code_pro = $_POST['code_pro'];
$price = $_POST['price'];
$id_user = $_POST['id_user'];
$id_product_variant = $_POST['id_product_variant'];
  $dataInsert = [
        'id_user'=>$id_user,
        'id_product_variant'=>$id_product_variant,
        'product_name'=>$name_product,
        'image'=>$img,
        'price'=>$price,
        'code_pro'=>$code_pro,
        'color_name'=>$id_color,
        'size_name'=>$id_size,
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
            'quantity' => ($quantity +1),
        ];
        $condition = "id = $idOrder"; 
        $updateStatus = update('orders', $dataUpdate, $condition);
        }else{
            $insertStatus = insert('orders', $dataInsert);
        }


