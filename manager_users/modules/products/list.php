<?php
if (!defined('_CODE')) { 
    die('Access denied....');
}
$data = [
    'pageTitle' => 'Danh sách sản phẩm',
];
layouts('headers/header', $data);
//Kiểm tra trạng thái đăng nhập
if (!isLogin()) {
    redirect('?module=auth&action=login');
}
//Truy vấn vào bảng products
$listProducts = getRaw("SELECT * FROM products order by create_at");
$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
?>
<!-- html -->
 <div class="container-pro">
    <hr>
    <div style="display: flex; justify-content: space-between;">
   <h2>Quản lý Sản Phẩm</h2>
   <p>
      <a href="?module=products&action=add" class="btn btn-success btn-sm">Thêm sản phẩm <i class="fa-solid fa-plus"></i> </a>
   </p>
   </div>
   <?php 
      if (!empty($smg)) {
          getSmg($smg, $smg_type);
      }
   ?>
   <table class="table mt-4 text">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên Sản Phẩm</th>
      <th scope="col">Mã Sản Phẩm</th>
      <th scope="col">Hình Ảnh</th>
      <!-- <th scope="col">Số Lượng</th>
      <th scope="col">Giá Bán</th>
      <th scope="col">Danh Mục</th>
      <th scope="col">Màu Sắc</th>
      <th scope="col">Kích Thước</th> -->
      <th scope="col">Mô Tả</th>
      <th>HDSD</th>
      <th scope="col">Ngày Nhập</th>
      <th scope="col">Sửa</th>
      <th scope="col">Chi Tiết</th>
      <th scope="col">Xóa</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($listProducts)):
    $count = 0; //STT
         foreach ($listProducts as $items):
            $count++;
    ?>
      <tr>
      <td><?php echo $count?></td>
      <td><?php echo $items['name'];?></td>
      <td><img style="width: 70px; height: 90px;" src="uploads/<?php echo $items['image'];?>" alt="" srcset=""></td>
      <td><?php echo $items['code_pro'];?></td>
      <td><?php echo $items['description']?></td>
      <td><?php echo $items['use_pro']?></td>
      <td><?php echo $items['create_at']?></td>
      <td><a href="<?php echo _WEB_HOST;?>?module=products&action=edit&id=<?php echo $items['id'];?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
      <td><a href="<?php echo _WEB_HOST;?>?module=products&action=viewAddVp&id=<?php echo $items['id'];?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-magnifying-glass"></i></a></td>
      <td><a href="<?php echo _WEB_HOST;?>?module=products&action=delete&id=<?php echo $items['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có muốn xóa không????')"><i class="fa-solid fa-trash"></i></a></td>
      </tr>
    <?php 
         endforeach;
      else :
   ?>
      <tr>
         <td colspan="7">
            <div class="alert alert-danger text-center">Không có sản phẩm nào!!!!</div>
         </td>
      </tr>
   <?php
    endif;
    ?>
   </tbody>
</table>
 </div>
<?php
layouts('footers/footer');
?>