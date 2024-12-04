<?php
if (!defined('_CODE')) {
    die('Access defined...');
}
$listCate = getRaw("SELECT * FROM categories ORDER BY update_at");
if (isPost()) {
    $filterAll = filter();
    $erros=[];
    if(empty($filterAll['name'])) {
        $erros['name']['required'] = ' Tên Danh Mục Không Được Để Trống';
    }
    if (empty($erros)) {
        $dataInsert = [
            'name'=>$filterAll['name'],
            'cate_id'=>$filterAll['cate_id'],
            'create_at'=>date('Y-m-d'),
            'update_at'=>date('Y-m-d'),
        ];
        $insertStatus = insert('danhmuc', $dataInsert);
        if ($dataInsert) {
            setFlashData('smg', 'Thêm mới thành công');
            setFlashData('smg_type','success');
            redirect('?module=danhMuc&action=add');
        }else {
            setFlashData('smg', 'Thêm mới không thành công');
            setFlashData('smg_type', 'danger');
        }
        redirect('?module=danhMuc&action=add');
    }else {
        setFlashData('smg', 'Vui Lòng Kiểm Tra Lại Dữ Liệu!!');
        setFlashData('smg_type', 'danger');
        setFlashData('erros',$erros);
        setFlashData('old', $filterAll);
        redirect('?module=danhMuc&action=add');
    }
};
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
                    <input type="text" class="form-control" name="name" placeholder="Tên danh mục">
                    <?php
                        echo form_erros('name', $erros, '<span class = "erros">','</span>');
                     ?>
                </div>
                <div class="from-group mg-form">
                    <label for="">Danh Mục:</label>
                    <select class="form-control" name="cate_id" id="">
                        <?php 
                        foreach ($listCate as $items) :
                         
                         ?>
                        <option value="<?php echo $items['id'];?>"><?php echo $items['name_cate'];?></option>   
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mg-btn mt-4">Thêm Danh Mục Sản Phẩm</button>
        <p class="text-center mt-4"><a href="?module=colors_sizes&action=list">Quay lại</a></p>
    </form>
</div>
<?php 
layouts('footers/footer-login');
?>