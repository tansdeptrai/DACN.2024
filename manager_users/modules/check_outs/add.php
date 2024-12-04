<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$province = $_POST['province'];
$district = $_POST['district'];
$ward = $_POST['ward'];
$address = $_POST['address'];
$pay = $_POST['pay'];
$totalPrice = $_POST['totalPrice'];
$idPros = $_POST['idPros'];
$code_cart = $_POST['codeCart'];
foreach ($idPros as $ids) {
   foreach ($ids as $id) {
        $products = getRaw("SELECT * FROM orders WHERE id = $id");
        foreach ($products as $pro) {
            $dataInsert = [
                'id_user'=>$pro['id_user'],
                'code_carts'=>$code_cart,
                'name'=>$name,
                'phone'=>$phone,
                'province_id'=>$province,
                'district_id'=>$district,
                'ward_id'=>$ward,
                'address'=>$address,
                'method_pay'=>$pay,
                'name_product'=>$pro['product_name'],
                'image_product'=>$pro['image'],
                'code_product'=>$pro['code_pro'],
                'size_product'=>$pro['size_name'],
                'color_product'=>$pro['color_name'],
                'quantity_product'=>$pro['quantity'],
                'total_price'=>$totalPrice,
                'create_at'=> date('Y-m-d'),
            ];
            $insertStatus = insert("carts", $dataInsert);
            if ($insertStatus) {
                $idProVariant = $pro['id_product_variant'];
                $quantity = getRaw("SELECT quantity FROM variant_products WHERE id = $idProVariant");
                foreach ($quantity as $quanti) {
                    foreach ($quanti as $q) {
                        $lastQuanti = $q - $pro['quantity'];
                        $dataUpdate = [
                            'quantity'=>$lastQuanti,
                        ];
                        $condition = "id= $idProVariant";
                        $updateStatus = update("variant_products", $dataUpdate, $condition);
                        if ($updateStatus) {
                            $id = $pro['id'];
                            $deleteStatus = delete('orders', "id = $id");
                            if ($deleteStatus) {
                            echo "Đặt Hàng Thành Công - Vui Lòng Kiểm Tra Trạng Thái Đơn Hàng Trong Mục Tài Khoản !!";                            
                            }
                        }
                    }
                }
            }
        }
   }
}
