<?php
if ($_POST['idColor'] && $_POST['idSize'] && $_POST['price'] && $_POST['quantity'] && $_FILES['image'] && $_FILES['images'] && $_POST['idProduct'] && $_POST['idCate']) {
    $idColor = $_POST['idColor'];
    $idSize = $_POST['idSize'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $img = $_FILES['image'];
    $imgDetail = $_FILES['images'];
    $idProduct = $_POST['idProduct'];
    $idCate = $_POST['idCate'];
    if (!empty($_FILES['images'])) {
        for ($i=0; $i < count($imgDetail['name']) ; $i++) { 
            $fileNameAb = $imgDetail['name'][$i];
            $fileTmpName = $imgDetail['tmp_name'][$i];
            $target_dir = "uploads/anbums";
            $target_file = $target_dir . basename($fileNameAb);
            move_uploaded_file($fileTmpName, $target_file);
            $dataInsertAb = [
                'id_product'=>$idProduct,
                'id_color'=>$idColor,
                'img'=>$fileNameAb,
                'create_at'=>date('Y-m-d'),
            ];
            $insertAbStatus = insert('ab_products', $dataInsertAb);
            if ($insertAbStatus) {
                $response['sucsses'] = 'Thanh Cong!'; 
            }else {
                $response['error']= 'That Bai!';
            }
        }
    }else {
        $response['errorr'] = 'Lỗi Hệ Thống!!';
    }
    if (!empty($_FILES)) {
        $fileName = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }
    $dataInsert = [
        'product_id'=>$idProduct,
        'image'=>$fileName,
        'quantity'=>$quantity,
        'color_id'=>$idColor,
        'cate_id'=>$idCate,
        'size_id'=>$idSize,
        'price'=>$price,
        'create_at'=>date('Y-m-d'),
        'update_at'=>date('Y-m-d'),
    ];
    $insertStatus = insert('variant_products', $dataInsert);
    $dataInsertAbProduct = [
        'id_product'=>$idProduct,
        'id_color'=>$idColor,
        'img'=>$fileNameAbImg,
    ];
    if ($insertStatus) {
        $response['success'] = 'Thêm sản phẩm thành công'; 
    }else {
            $response['errorInsert'] = 'Thêm sản phẩm không thành công'; 
    }

}else {
    $response['error'] = 'hệ thống lỗi!'; 
}
header('Content-Type: application/json');
echo json_encode($response);