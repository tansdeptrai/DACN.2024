<h1>HIHI đây là xóa nha</h1>
<?php
if (!defined('_CODE')) {
    die('Access denied.....');
}
$filterAll = filter();
if (!empty($filterAll['id'])) {
    $pro_Id = $filterAll['id'];
    $proDetail = oneRaw("SELECT * FROM products WHERE id =$pro_Id");
    // echo '<pre>';
    // print_r($proDetail);
    // echo '<br>';
    // echo $current_image;
    // echo '<pre>';
    // die;
    if ($proDetail > 0) {
        //Thực Hiện Xóa
         // Xóa file ảnh nếu có
        $deletePro = delete('products', "id=$pro_Id");
        if ($deletePro) {
            setFlashData('smg', 'Xóa thành công!');
            setFlashData('smg_type', 'success');
        }else {
            setFlashData('smg','Xóa thất bại!!');
            setFlashData('smg_type','danger');
        }
    }else {
        setFlashData('smg', 'Sản Phẩm không tồn tại trong hệ thống');
        setFlashData('smg_type', 'danger');
    }
}else {
    setFlashData('smg', 'Liên kết không tồn tại hoặc đã bị hỏng!');
    setFlashData('smg_type', 'danger');
}
redirect('?module=products&action=list');