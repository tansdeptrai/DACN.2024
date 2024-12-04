<?php
if (!defined('_CODE')) {
    die('Access denied.....');
}
//Kiểm tra trạng thái đăng nhập
if (!isLogin()) {
    redirect('?module=auth&action=login');
}
//Thực hiện truy vấn vào bảng colors & sizes & cate
$listColors = getRaw("SELECT * FROM colors ORDER BY create_at");
$listSizes = getRaw("SELECT * FROM sizes ORDER BY create_at");
$listCate = getRaw("SELECT * FROM categories ORDER BY update_at");
$listProducts = getRaw("SELECT * FROM products ORDER BY create_at");
$listDm = getRaw("SELECT d.id, d.name, d.cate_id, c.name_cate FROM danhmuc d INNER JOIN  categories c ON d.cate_id = c.id;");
//Thêm Mới Biến Thể Sản Phẩm
if (isPost()) {
    $filterAll = filter();
    $erros = [];
    if (empty($filterAll['quantity'])) {
        $erros['quantity']['required'] = 'Tên sản phẩm không được để trống';
    }
    if (empty($filterAll['price'])) {
        $erros['price']['required'] = 'Thông tin sản phẩm không được để trống';
    }
    if (empty($_FILES)) {
        $erros['image']['required'] = 'Hình ảnh sản phẩm không được để trống';
    }
    if (empty($erros)) {
       if (!empty($_FILES)) {
        $filename = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
       }
       $dataInsert = [
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
       $insertStatus = insert('variant_products', $dataInsert);
       if ($insertStatus) {
        setFlashData('smg', 'Thêm sản phẩm thành công!');
        setFlashData('smg_type', 'success');
        redirect('?module=colors_sizes&action=list');
       }else {
        setFlashData('smg', 'Thêm mới sản phẩm không thành công!!!');
        setFlashData('smg_type', 'danger');
       }
       redirect('?module=colors_sizes&action=list');
    }else{
        setFlashData('smg', 'Vui Lòng Kiểm Tra Lại Dữ Liệu!!');
        setFlashData('smg_type', 'danger');
        setFlashData('erros',$erros);
        setFlashData('old', $filterAll);
        redirect('?module=colors_sizes&action=list');
    }
}
//
$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$erros = getFlashData('erros');
$data = [
    'pageTitle'=>'Danh sách màu và kích thước'
];
layouts('headers/header', $data);
?>
<div class="container-pro">
    <hr>
    <?php 
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
    ?>
    <div class="row">
        <div class="col">
            <div style="display: flex; justify-content: space-between;">
                <h2>Quản lý màu sắc</h2>
                <p>
                    <a href="?module=colors_sizes/colors&action=add" class="btn btn-success btn-sm">Thêm Màu <i class="fa-solid fa-plus"></i> </a>
                </p>
            </div>
            <table class="table table-bordered">
                <thead>
                    <th>STT</th>
                    <th>Màu Sắc</th>
                    <th>Hiển thị</th>
                    <th style="width: 5%;">Sửa</th>
                    <th style="width: 5%;">Xóa</th>
                </thead>
                <tbody>
                   <?php
                    if (!empty($listColors)):
                        $count = 0;
                        foreach ($listColors as $colors):
                            $count++;
                   ?>
                    <tr>
                        <td><?php echo $count?></td>
                        <td> <?php echo $colors['name_color']?></td>
                        <td>
                            <div style="width: 25px; height: 25px; background-color: <?php echo $colors['color_code']?>;"></div>
                        </td>
                        <td><a href="<?php echo _WEB_HOST;?>?module=colors_sizes/colors&action=edit&id=<?php echo $colors['id']?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="<?php echo _WEB_HOST;?>?module=colors_sizes/colors&action=delete&id=<?php echo $colors['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có muốn xóa không????')"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                    <?php
                        endforeach;
                    else:
                    ?>
                    <tr>
                        <td colspan="7">
                            <div class="alert alert-danger text-center">Không có dữ liệu!!!!</div>
                        </td>
                    </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col">
        <div style="display: flex; justify-content: space-between;">
            <h2>Quản lý kích thước</h2>
            <p>
                <a href="?module=colors_sizes/sizes&action=add" class="btn btn-success btn-sm mt-1">Thêm Size <i class="fa-solid fa-plus"></i> </a>
            </p>
        </div>
        <table class="table table-bordered">
                <thead>
                    <th>STT</th>
                    <th>Size</th>
                    <th style="width: 5%;">Sửa</th>
                    <th style="width: 5%;">Xóa</th>
                </thead>
                <tbody>
                    <?php
                    if (!empty($listSizes)):
                        $count=0;
                        foreach ($listSizes as $sizes):
                            $count++;
                    ?>
                    <tr>
                        <td><?php echo $count?></td>
                        <td><?php echo $sizes['name_size']?></td>
                        <td><a href="<?php echo _WEB_HOST;?>?module=colors_sizes/sizes&action=edit&id=<?php echo $sizes['id']?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="<?php echo _WEB_HOST;?>?module=colors_sizes/sizes&action=delete&id=<?php echo $sizes['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có muốn xóa không????')"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                        <?php endforeach;
                        else:
                        ?>
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-danger text-center">Không có dữ liệu!!!!</div>
                            </td>
                        </tr>
                        <?php
                        endif;
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-8">
            <div style="display: flex; justify-content: space-between;">
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
                        ?>
                        <option value="<?php echo $items['id']?>"><?php echo $items['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="from-group mg-form">
                    <label for="">Danh Mục Sản Phẩm:</label>
                    <select name="cate_id" id="" class="form-control">
                        <?php 
                        foreach ($listDm as $items):
                        ?>
                        <option value="<?php echo $items['id']?>"><?php echo $items['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="from-group mg-form">
                    <label for="">Hình Ảnh:</label>
                    <input type="file" class="form-control" name="image" placeholder="Lựa chọn hình ảnh" value="">
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
                        ?>
                        <option value="<?php echo $items['id']?>"><?php echo $items['name_color']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="from-group mg-form">
                    <label for="">Size:</label>
                    <select name="size_id" id="" class="form-control">
                    <?php 
                        foreach ($listSizes as $items):
                        ?>
                        <option value="<?php echo $items['id']?>"><?php echo $items['name_size']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="from-group mg-form">
                    <label for="">Giá Bán:</label>
                    <input type="text" class="form-control" name="price" placeholder="Giá bán sản phẩm" value="">
                    <?php
                    echo form_erros('price', $erros, '<span class = "erros">','</span>', );
                    ?>
                </div>
                <div class="from-group mg-form">
                    <label for="">Số Lượng:</label>
                    <input type="text" class="form-control" name="quantity" placeholder="Số lượng sản phẩm" value="">
                    <?php
                    echo form_erros('quantity', $erros, '<span class = "erros">','</span>', );
                    ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mg-btn mt-4">Thêm Sản Phẩm</button>
    </form>
        </div>
        <div class="col-4">
            <div style="display: flex; justify-content: space-between;">
                <h2>Quản lý Danh Mục</h2>
                <p>
                    <a href="?module=categories&action=add" class="btn btn-success btn-sm mt-1">Thêm Danh Mục <i class="fa-solid fa-plus"></i> </a>
                </p>
            </div>
            <table class="table table-bordered">
            <thead>
                <th>STT</th>
                <th>Tên Danh Mục</th>
                <!-- <th>Danh Mục</th> -->
                <th style="width: 5%;">Sửa</th>
                <th style="width: 5%;">Xóa</th>
            </thead>
            <tbody>
                <?php
                if(!empty($listCate)):
                    $count =0;
                    foreach ($listCate as $items) :
                        $count++;
                ?>   
                <tr>
                    <td><?php echo $count?></td>
                    <td><?php echo $items['name_cate']?></td>
                    <td><a href="<?php echo _WEB_HOST;?>?module=categories&action=edit&id=<?php echo $items['id']?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a href="<?php echo _WEB_HOST;?>?module=categories&action=delete&id=<?php echo $items['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có muốn xóa không???')"><i class="fa-solid fa-trash"></i></a></td>
                </tr> 
                <?php
                    endforeach;
                else :
                ?>
                <tr>
                    <td colspan="7">
                        <div class="alert alert-danger text-center">Không có Danh Mục Nào</div>
                    </td>
                </tr>
                <?php
                endif;
                ?>
            </tbody>
            </table>
            <hr>
            <div style="display: flex; justify-content: space-between;">
            <h2>Quản lý Danh Mục Sản Phẩm</h2>
            <p>
                <a href="?module=danhMuc&action=add" class="btn btn-success btn-sm mt-1">Thêm Danh Mục Sản Phẩm <i class="fa-solid fa-plus"></i> </a>
            </p>
        </div>
        <table class="table table-bordered">
        <thead>
            <th>STT</th>
            <th>Tên Danh Mục</th>
            <th>Danh Mục</th>
            <th style="width: 5%;">Sửa</th>
            <th style="width: 5%;">Xóa</th>
        </thead>
        <tbody>
            <?php
            if(!empty($listDm)):
                $count =0;
                foreach ($listDm as $items) :
                    $count++;
            ?>   
            <tr>
                <td><?php echo $count?></td>
                <td><?php echo $items['name']?></td>
                <td><?php echo $items['name_cate']?></td>
                <td><a href="<?php echo _WEB_HOST;?>?module=danhMuc&action=edit&id=<?php echo $items['id']?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href="<?php echo _WEB_HOST;?>?module=danhMuc&action=delete&id=<?php echo $items['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có muốn xóa không???')"><i class="fa-solid fa-trash"></i></a></td>
            </tr> 
            <?php
                endforeach;
            else :
            ?>
            <tr>
                <td colspan="7">
                    <div class="alert alert-danger text-center">Không có Danh Mục Nào</div>
                </td>
            </tr>
            <?php
            endif;
            ?>
        </tbody>
        </table>
        </div>
    </div>
</div>

<?php 
layouts('footers/footer');
?>
