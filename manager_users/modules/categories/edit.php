<?php
if (!defined('_CODE')) {
    die('Access denied....');
}
$filterAll = filter();
if (!empty($filterAll['id'])) {
    $user_Id = $filterAll['id'];
    $cateDetail = oneRaw("SELECT * FROM categories WHERE id='$user_Id'");
    if (!empty($cateDetail)) {
        setFlashData('cate-detail', $cateDetail);
    }else {
        redirect('?module=categories&action=list');
    }
};
if (isPost()) {
    $filterAll = filter();
    $erros = []; 
    if (empty($filterAll['name_cate'])) {
        $erros['name_cate']['required'] = 'Tên danh mục không được để trống';
    }
    if (empty($erros)) {
        $dataUpdate = [
            'name_cate'=> $filterAll['name_cate'],
        ];
        $condition = "id= $user_Id";
        $updateStatus = update('categories', $dataUpdate, $condition);
        if ($updateStatus) {
            setFlashData('smg', 'Chỉnh sửa thông tin thành công');
            setFlashData('smg_type', 'success');
        }else {
            setFlashData('smg', 'Chỉnh sửa thông tin không thành công');
            setFlashData('smg_type', 'danger');
        }
    }else {
        setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu!!');
        setFlashData('smg_type', 'danger');
        setFlashData('erros', $erros);
        setFlashData('old', $filterAll);
    }
    redirect('?module=categories&action=edit&id='.$user_Id);
}



$data = [
    'pageTitle' => 'Chỉnh sửa danh mục',
];
layouts('headers/header-login',$data);
$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$erros = getFlashData('erros');
$old = getFlashData('old');
$userDetail = getFlashData('cate-detail');
if (!empty($userDetail)) {
    $old = $userDetail;
}
?>
<div class="container">
    <div class="row">
        <h2 class="text-center text-uppercase mt-5">Thêm Danh Mục Sản Phẩm</h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
        ?>
    </div>
    <form action="" method="post">
        <div class="row">
            <div class="col">
                <div class="from-group mg-form">
                    <label for="">Tên Danh Mục:</label>
                    <input type="text" class="form-control" name="name_cate" placeholder="Tên danh mục" value="<?php echo oldData('name_cate', $old)?>">
                    <?php
                        echo form_erros('name_cate',$erros, '<span class = "erros">','</span>', );
                     ?>
                </div>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $user_Id?>">
        <button type="submit" class="btn btn-primary btn-block mg-btn mt-4">Lưu Thông Tin</button>
        <p class="text-center mt-4"><a href="?module=colors_sizes&action=list">Quay lại</a></p>
    </form>
</div>
<?php 
layouts('footers/footer-login')
?>