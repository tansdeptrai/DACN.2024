<?php
if (!defined('_CODE')) {
    die('Access defined...');
}
//Truy vấn thông tin của categories
$listColors = getRaw("SELECT * FROM colors ORDER BY create_at");
$listSizes = getRaw("SELECT * FROM sizes ORDER BY create_at");
$listCate = getRaw("SELECT * FROM danhmuc ORDER BY update_at");
$listProducts = getRaw("SELECT * FROM products ORDER BY create_at");
//
$filterAll = filter();
if (!empty($filterAll['id'])) {
    $pro_id = $filterAll['id'];
    $detailProducts = oneRaw("SELECT * FROM variant_products  WHERE id = $pro_id;");
};
// echo '<pre>';
// print_r($detailProducts);
// echo '</pre>';
// die;
if (isPost()) {
    $filterAll = filter();
    $erros = [];
    if (empty($erros)) {
       if (!empty($_FILES)) {
        $current_image = $detailProducts['image'];
        $upload_dir = 'uploads/';
        if ($current_image && file_exists($upload_dir . $current_image)) {
            unlink($upload_dir . $current_image);
        }
        $filename = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
       }
       if ($_FILES['image']['name']) {
        $dataUpdate = [
        'product_id' => $filterAll['product_id'],
        'image' => $filename,
        'color_id' => $filterAll['color_id'],
        'cate_id' => $filterAll['cate_id'],
        'size_id' => $filterAll['size_id'],
        'quantity'=>$filterAll['quantity'],
        'price' => $filterAll['price'],
        'create_at'=>date('Y-m-d'),
        'update_at'=>date('Y-m-d'),
           ];
           $condition = "id = $pro_id";
           $updateStatus = update('variant_products', $dataUpdate, $condition);
       }else {
        $dataUpdate = [
        'product_id' => $filterAll['product_id'],
        'color_id' => $filterAll['color_id'],
        'cate_id' => $filterAll['cate_id'],
        'size_id' => $filterAll['size_id'],
        'quantity'=>$filterAll['quantity'],
        'price' => $filterAll['price'],
        'create_at'=>date('Y-m-d'),
        'update_at'=>date('Y-m-d'),
           ];
           $condition = "id = $pro_id";
           $updateStatus = update('variant_products', $dataUpdate, $condition);
       }

       if ($updateStatus) {
        setFlashData('smg', 'Thay đổi thông tin sản phẩm thành công!');
        setFlashData('smg_type', 'success');
        redirect('?module=colors_sizes/variantProduct&action=list');
       }else {
        setFlashData('smg', 'Thay đổi thông tin sản phẩm không thành công!!!');
        setFlashData('smg_type', 'danger');
       }
       redirect('?module=colors_sizes/variantProduct&action=edit');
    }else{
        setFlashData('smg', 'Vui Lòng Kiểm Tra Lại Dữ Liệu!!');
        setFlashData('smg_type', 'danger');
        setFlashData('erros',$erros);
        setFlashData('old', $filterAll);
        redirect('?module=colors_sizes/variantProduct&action=edit');
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
    <div class="container-pro">
    <div class="row">
    <div class="col">
            <div style="display: flex; justify-content:center; margin-top: 50px;">
                <h2>Thêm Biến Thể Cho Sản Phẩm</h2>
            </div>
            <form class="mt-4" action="" method="post" enctype="multipart/form-data">
            <div class="row">
            <div class="col">
                <div class="from-group mg-form">
                    <label for="">Sản Phẩm:</label>
                    <select name="product_id" id="" class="form-control">
                    <?php 
                        foreach ($listProducts as $items):
                        $selected = ($items['id'] == $detailProducts['product_id']) ? 'selected' : 'huhu';
                        ?>
                        <option value="<?php echo $items['id']?>" <?php echo $selected;?>><?php echo $items['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="from-group mg-form">
                    <label for="">Danh Mục Sản Phẩm:</label>
                    <select name="cate_id" id="" class="form-control">
                        <?php 
                        foreach ($listCate as $items):
                            $selected = ($items['id'] == $detailProducts['cate_id']) ? 'selected' : 'huhu';
                        ?>
                        <option value="<?php echo $items['id']?>" <?php echo $selected;?>><?php echo $items['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="from-group mg-form">
                    <label for="">Hình Ảnh:</label>
                    <input type="file" class="form-control" name="image" placeholder="Lựa chọn hình ảnh" value="">
                    <img class="mt-2" style="width: 70px; height: 90px;" src="uploads/<?php echo $detailProducts['image'];?>" alt="" srcset="">
                    <?php
                    echo form_erros('image',$erros, '<span class = "erros">','</span>',);
                    ?>
                </div>
            </div>
            <div class="col">
                <div class="from-group mg-form">
                    <label for="">Màu Sắc:</label>
                    <select name="color_id" id="" class="form-control">
                    <?php 
                        foreach ($listColors as $items):
                        $selected = ($items['id'] == $detailProducts['color_id']) ? 'selected' : 'huhu';
                        ?>
                        <option value="<?php echo $items['id']?>" <?php echo $selected;?>><?php echo $items['name_color']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="from-group mg-form">
                    <label for="">Size:</label>
                    <select name="size_id" id="" class="form-control">
                    <?php 
                        foreach ($listSizes as $items):
                        $selected = ($items['id'] == $detailProducts['size_id']) ? 'selected' : 'huhu';
                        ?>
                        <option value="<?php echo $items['id']?>" <?php echo $selected;?>><?php echo $items['name_size']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="from-group mg-form">
                    <label for="">Giá Bán:</label>
                    <input type="text" class="form-control" name="price" placeholder="Giá bán sản phẩm" value="<?php echo $detailProducts['price'];?>">
                    <?php
                    ?>
                </div>
                <div class="from-group mg-form">
                    <label for="">Số Lượng:</label>
                    <input type="text" class="form-control" name="quantity" placeholder="Số lượng sản phẩm" value="<?php echo $detailProducts['quantity'];?>">
                    <?php
                    ?>
                </div>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $pro_id?>">
        <button type="submit" class="btn btn-primary btn-block mg-btn mt-4">Thay Đổi Sản Phẩm</button>
    </form>
    </div>
    </div>
    </div>
<?php layouts('footers/footer-login');?>