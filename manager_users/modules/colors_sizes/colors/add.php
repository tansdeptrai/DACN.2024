<?php
if (!defined('_CODE')) {
    die('Access denied...');
}
if (isPost()) {
    $filterAll = filter();
    $erros =[];
    if (empty($filterAll['name_color'])) {
        $erros['name_color']['required'] = 'Không được để trống màu sắc';
    }
    if (empty($filterAll['color_code'])) {
        $erros['color_code']['required'] = 'Mã màu không được để trống';
    }
    if (empty($erros)) {
        $dataInsert = [
            'name_color'=> $filterAll['name_color'],
            'color_code'=> $filterAll['color_code'],
            'create_at'=> date('Y-m-d'),
        ];
        $insertStatus = insert('colors', $dataInsert);
        if ($insertStatus) {
            setFlashData('smg', 'Thêm mới màu thành công!!');
            setFlashData('smg_type', 'success');
            redirect('?module=colors_sizes/colors&action=add');
        }else {
            setFlashData('smg','Thêm mới màu không thành công!');
            setFlashData('smg_type', 'danger');
        }
        redirect('?module=colors_sizes/colors&action=add');
    }else {
        setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu');
        setFlashData('smg_type', 'danger');
        setFlashData('erros', $erros);
    }
};
$data = [
    'pageTitle'=> ' Thêm mới màu sắc'
];
layouts('headers/header-login',$data);
$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$erros = getFlashData('erros');
$old = getFlashData('old');
?>
<div class="container">
    <div class="row" style="margin:50px auto;">
        <h2 class="text-center text-uppercase">Thêm Màu Sắc</h2>
        <?php 
            if (!empty($smg)) {
                getSmg($smg, $smg_type);
            }
        ?>
        <form action="" method="post">
            <div class="row">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Tên Màu:</label>
                        <input type="text" name="name_color" class="form-control" placeholder="Nhập tên màu sắc" value="<?php echo oldData('name_color', $old)?>">
                        <?php
                        echo form_erros('name_color',$erros, '<span class="erros">', '</span>', );
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Mã Màu:</label>
                        <input type="text" name="color_code" class="form-control" placeholder="Nhập tên màu sắc" value="<?php echo oldData('color_code', $old)?>">
                        <?php
                        echo form_erros('color_code',$erros, '<span class="erros">', '</span>',);
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