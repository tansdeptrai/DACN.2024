<?php 
    if (!defined('_CODE')) {
        die('Access defined....');
    }
    $filterAll = filter();
    if (!empty($filterAll['id'])) {
        $size_Id = $filterAll['id'];
        $sizesDetail = oneRaw("SELECT * FROM sizes WHERE id = '$size_Id'");
        if (!empty($sizesDetail)) {
            setFlashData('size-detail', $sizesDetail);
        }else {
            redirect('?module=color_sizes&action=list');
        }
    }
    if (isPost()) {
        $filterAll = filter();
        $erros=[];
        if (empty($filterAll['name_size'])) {
            $erros['name_size']['required'] = 'Size không được để trống!';
        }
        if (empty($erros)) {
            $dataUpdate = [
                'name_size' => $filterAll['name_size'],
                'create_at' => date('Y-m-d'),
            ];
            $condition = "id = $size_Id";
            $updateStatus = update('sizes', $dataUpdate, $condition);
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
    $sizeDetail = getFlashData('size-detail');
    if (!empty($sizeDetail)) {
        $old = $sizeDetail;
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
                        <label for="">Size:</label>
                        <input type="text" name="name_size" class="form-control" placeholder="Nhập tên màu sắc" value="<?php echo oldData('name_size', $old)?>">
                        <?php
                        echo form_erros('name_size',$erros, '<span class="erros">', '</span>');
                        ?>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $size_Id?>">
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