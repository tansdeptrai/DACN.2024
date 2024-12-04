<h1>HIHI đây là xóa nha</h1>
<?php
if (!defined('_CODE')) {
    die('Access denied.....');
}
$filterAll = filter();
if (!empty($filterAll['id'])) {
    $cate_Id = $filterAll['id'];
    $cateDetail = getRows("SELECT * FROM danhmuc WHERE id =$cate_Id");
    if ($cateDetail > 0) {
        //Thực Hiện Xóa
        $deleteCate = delete('danhmuc', "id=$cate_Id");
        if ($deleteCate) {
            setFlashData('smg', 'Xóa thành công!');
            setFlashData('smg_type', 'success');
        }else {
            setFlashData('smg','Xóa thất bại!!');
            setFlashData('smg_type','danger');
        }
    }else {
        setFlashData('smg', 'Danh mục không tồn tại trong hệ thống');
        setFlashData('smg_type', 'danger');
    }
}else {
    setFlashData('smg', 'Liên kết không tồn tại hoặc đã bị hỏng!');
    setFlashData('smg_type', 'danger');
}
redirect('?module=color_sizes&action=list');