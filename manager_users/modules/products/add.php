<?php
if (!defined('_CODE')) {
    die('Access defined...');
}
if (isPost()) {
    $filterAll = filter();
    $erros = [];
    if (empty($filterAll['name'])) {
        $erros['name']['required'] = 'Tên sản phẩm không được để trống';
    }
    if (empty($filterAll['use_pro'])) {
        $erros['use_pro']['required'] = 'Tên sản phẩm không được để trống';
    }
    if (empty($filterAll['code_pro'])) {
        $erros['code_pro']['required'] = 'Mã sản phẩm không được để trống';
    }
    if (empty($filterAll['description'])) {
        $erros['description']['required'] = 'Thông tin sản phẩm không được để trống';
    }
    // if (empty($filterAll['image'])) {
    //     $erros['image']['required'] = 'Thêm hình ảnh sản phẩm';
    // }
    if (empty($erros)) {
       if (!empty($_FILES)) {
        $filename = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
       }
       $dataInsert = [
        'name' => $filterAll['name'],
        'image' => $filename,
        'code_pro'=>$filterAll['code_pro'],
        'description' => $filterAll['description'],
        'use_pro' => $filterAll['use_pro'],
        'create_at'=>date('Y-m-d'),
        'update_at'=>date('Y-m-d'),
       ];
       $insertStatus = insert('products', $dataInsert);
       if ($insertStatus) {
        setFlashData('smg', 'Thêm sản phẩm thành công!');
        setFlashData('smg_type', 'success');
        redirect('?module=products&action=add');
       }else {
        setFlashData('smg', 'Thêm mới sản phẩm không thành công!!!');
        setFlashData('smg_type', 'danger');
       }
       redirect('module=products&action=add');
    }else{
        setFlashData('smg', 'Vui Lòng Kiểm Tra Lại Dữ Liệu!!');
        setFlashData('smg_type', 'danger');
        setFlashData('erros',$erros);
        setFlashData('old', $filterAll);
        redirect('?module=products&action=add');
    }
}
$data = [
    'pageTitle' => 'Thêm mới sản phẩm',
];
layouts('headers/header-login', $data);
$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$erros = getFlashData('erros');
?>
<div class="container">
    <div class="row">
        <h2 class="text-center text-uppercase">Thêm Sản Phẩm</h2>
        <?php
             if(!empty($smg)){
                getSmg($smg, $smg_type);
              }
        ?>
    </div>
    <form class="mt-4" action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <div class="from-group mg-form">
                    <label for="">Tên Sản Phẩm:</label>
                    <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="">
                    <?php
                    echo form_erros('name', $erros, '<span class = "erros">','</span>', );
                    ?>
                </div>
                <div class="from-group mg-form">
                    <label for="">Mã Sản Phẩm:</label>
                    <input type="text" class="form-control" name="code_pro" placeholder="Mã sản phẩm" value="">
                    <?php
                    echo form_erros('code_pro', $erros, '<span class = "erros">','</span>', );
                    ?>
                </div>
                <div class="from-group mg-form">
                    <label for="">Hình Ảnh:</label>
                    <input type="file" class="form-control" name="image" placeholder="Lựa chọn hình ảnh" value="">
                    <?php
                    echo form_erros('image',$erros, '<span class = "erros">','</span>',);
                    ?>
                </div>
               <div class="d-flex ">
               <div class="from-group mg-form">
                    <label for="">Thông Tin Sản Phẩm:</label><br>
                    <textarea name="description" id="" rows="15" cols="82" wrap="hard"></textarea>
                    <?php
                    echo form_erros('description',$erros, '<span class = "erros">','</span>', );
                    ?>
                </div>
                <div class="from-group mg-form mx-5">
                    <label for="">Hướng Dẫn Sử Dụng</label><br>
                    <textarea name="use_pro" id="" rows="15" cols="82" wrap="hard"></textarea>
                    <?php
                    echo form_erros('use_pro',$erros, '<span class = "erros">','</span>', );
                    ?>
                </div>
               </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mg-btn mt-4">Thêm Sản Phẩm</button>
        <p class="text-center mt-4"><a href="?module=products&action=list">Quay lại</a></p>
    </form>
</div>
<?php layouts('footers/footer-login')?>