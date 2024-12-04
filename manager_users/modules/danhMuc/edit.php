<?php
if (!defined('_CODE')) {
    die('Access denied....');
}
$listCate = getRaw("SELECT * FROM categories ORDER BY update_at");
$filterAll = filter();
if (!empty($filterAll['id'])) {
    $user_Id = $filterAll['id'];
    $cateDetail = oneRaw("SELECT * FROM danhmuc WHERE id='$user_Id'");
    if (!empty($cateDetail)) {
        setFlashData('cate-detail', $cateDetail);
    }else {
        redirect('?module=colors_sizes&action=list');
    }
};
if (isPost()) {
    $filterAll = filter();
    $erros = []; 
    if (empty($filterAll['name'])) {
        $erros['name']['required'] = 'Tên danh mục không được để trống';
    }
    if (empty($erros)) {
        $dataUpdate = [
            'name'=> $filterAll['name'],
            'cate_id'=>$filterAll['cate_id'],
            'update_at'=>date('Y-m-d'),
        ];
        $condition = "id= $user_Id";
        $updateStatus = update('danhmuc', $dataUpdate, $condition);
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
                    <input type="text" class="form-control" name="name" placeholder="Tên danh mục" value="<?php echo oldData('name', $old)?>">
                    <?php
                        echo form_erros('name_cate',$erros, '<span class = "erros">','</span>', );
                     ?>
                </div>
                <div class="from-group mg-form">
                    <label for="">Danh Mục</label>
                    <select name="cate_id" id="" class="form-control">
                        <?php 
                        foreach ($listCate as $items):
                            $selected = ($items['id'] == $cateDetail['cate_id']) ? 'selected' : 'huhu';
                        ?>
                        <option value="<?php echo $items['id']?>" <?php echo $selected;?>><?php echo $items['name']?></option>
                        <?php endforeach; ?>
                    </select>
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