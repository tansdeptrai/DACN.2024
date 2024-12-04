<h1>HIHI đây là xóa nha</h1>
<?php
if (!defined('_CODE')) {
    die('Access denied.....');
}
$filterAll = filter();
if (!empty($filterAll['id'])) {
    $size_Id = $filterAll['id'];
    $sizeDetail = getRows("SELECT * FROM sizes WHERE id =$size_Id");
    if ($sizeDetail > 0) {
        //Thực Hiện Xóa
        $deleteCate = delete('sizes', "id=$size_Id");
        if ($deleteCate) {
            setFlashData('smg', 'Xóa thành công!');
            setFlashData('smg_type', 'success');
        }else {
            setFlashData('smg','Xóa thất bại!!');
            setFlashData('smg_type','danger');
        }
    }else {
        setFlashData('smg', 'Size không tồn tại trong hệ thống');
        setFlashData('smg_type', 'danger');
    }
}else {
    setFlashData('smg', 'Liên kết không tồn tại hoặc đã bị hỏng!');
    setFlashData('smg_type', 'danger');
}
redirect('?module=colors_sizes&action=list');