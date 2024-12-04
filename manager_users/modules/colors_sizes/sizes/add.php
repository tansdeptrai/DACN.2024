<?php
if (!defined('_CODE')) {
    die('Access denied...');
}
if (isPost()) {
    $filterAll = filter();
    $erros =[];
    if (empty($filterAll['name_size'])) {
        $erros['name_size']['required'] = 'Không được để trống';
    }
    if (empty($erros)) {
        $dataInsert = [
            'name_size'=> $filterAll['name_size'],
            'create_at'=> date('Y-m-d'),
        ];
        $insertStatus = insert('sizes', $dataInsert);
        if ($insertStatus) {
            setFlashData('smg', 'Thêm mới màu thành công!!');
            setFlashData('smg_type', 'success');
            redirect('?module=colors_sizes/sizes&action=add');
        }else {
            setFlashData('smg','Thêm mới size không thành công!');
            setFlashData('smg_type', 'danger');
        }
        redirect('?module=colors_sizes/sizess&action=add');
    }else {
        setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu');
        setFlashData('smg_type', 'danger');
        setFlashData('erros', $erros);
    }
};
$data = [
    'pageTitle'=> ' Thêm mới size'
];
layouts('headers/header-login',$data);
$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$erros = getFlashData('erros');
$old = getFlashData('old');
?>
<div class="container">
    <div class="row" style="margin:50px auto;">
        <h2 class="text-center text-uppercase">Thêm Mới Size</h2>
        <?php 
            if (!empty($smg)) {
                getSmg($smg, $smg_type);
            }
        ?>
        <form action="" method="post">
            <div class="row">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Size:</label>
                        <input type="text" name="name_size" class="form-control" placeholder="Nhập size" value="<?php echo oldData('name_size', $old)?>">
                        <?php
                        echo form_erros('name_size',$erros, '<span class="erros">', '</span>', );
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary mg-btn mt-4">Thêm Mới</button>
                <p class="text-center pt-4">
                    <a href="?module=colors_sizes&action=list">Quay Lại</a>
                </p>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
layouts('footers/footer-login');
?>