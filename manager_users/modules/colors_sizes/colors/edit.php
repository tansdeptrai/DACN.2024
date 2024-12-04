<?php 
    if (!defined('_CODE')) {
        die('Access defined....');
    }
    $filterAll = filter();
    if (!empty($filterAll['id'])) {
        $color_Id = $filterAll['id'];
        $colorDetail = oneRaw("SELECT * FROM colors WHERE id = '$color_Id'");
        if (!empty($colorDetail)) {
            setFlashData('color-detail', $colorDetail);
        }else {
            redirect('?module=color_sizes&action=list');
        }
    }
    if (isPost()) {
        $filterAll = filter();
        $erros=[];
        if (empty($filterAll['name_color'])) {
            $erros['name_color']['required'] = 'Màu sắc không được để trống!';
        }
        if (empty($filterAll['color_code'])) {
            $erros['color_code'] = 'Mã màu không được để trống!';
        }
        if (empty($erros)) {
            $dataUpdate = [
                'name_color' => $filterAll['name_color'],
                'color_code' => $filterAll['color_code'],
                'create_at' => date('Y-m-d'),
            ];
            $condition = "id = $color_Id";
            $updateStatus = update('colors', $dataUpdate, $condition);
            if ($updateStatus) {
                setFlashData('smg','Chỉnh sửa thông tin thành công');
                setFlashData('smg_type', 'success');
            }else {
                setFlashData('smg', 'Chỉnh sửa thông tin thất bại');
                setFlashData('smg_type', 'danger');
            }
        }else {
            setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu');
            setFlashData('smg_type', 'danger');
            setFlashData('erros', $erros);
            setFlashData('old', $old);
        }
        redirect('?module=colors_sizes&action=list');
    };
    $data=[
        'pageTitle' => 'Chỉnh sửa thông tin',
    ];
    layouts('headers/header-login', $data);
    $smg = getFlashData('smg');
    $smg_type = getFlashData('smg_type');
    $erros = getFlashData('erros');
    $old = getFlashData('old');
    $colorDetail = getFlashData('color-detail');
    if (!empty($colorDetail)) {
        $old = $colorDetail;
    }
    ?>
    <div class="container">
    <div class="row" style="margin:50px auto;">
        <h2 class="text-center text-uppercase">Sửa Màu Sắc</h2>
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
                        echo form_erros('color_code',$erros, '<span class="erros">', '</span>', );
                        ?>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $color_Id?>">
                    <button type="submit" class="btn btn-primary mg-btn mt-4">Lưu</button>
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