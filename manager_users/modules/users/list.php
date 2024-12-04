<?php
 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
 }
 $data = [
   'pageTitle' => 'Trang Danh Sách Tài Khoản',
];
 layouts('headers/header', $data);
 //Kiểm tra trạng thái đăng nhập
if (!isLogin()) {
   redirect('?module=auth&action=login');
}
//Truy vấn vào bảng users
$listUsers = getRaw("SELECT * FROM users ORDER BY update_at");
$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
?>
<!-- HTML -->
<div class="container-pro">
   <hr>
   <div style="display: flex; justify-content: space-between;">
   <h2>Quản lý người dùng</h2>
   <p>
      <a href="?module=users&action=add" class="btn btn-success btn-sm">Thêm tài khoản <i class="fa-solid fa-plus"></i> </a>
   </p>
   </div>
   <?php 
        if(!empty($smg)){
          getSmg($smg, $smg_type);
        }
      ?>
   <table class="table table-bordered">
   <thead>
      <th>STT</th>
      <th>Họ Tên</th>
      <th>Email</th>
      <th>SĐT</th>
      <th>Trạng Thái</th>
      <th>Vai Trò</th>
      <th style="width: 5%;">Sửa</th>
      <th style="width: 5%;">Xóa</th>
   </thead>
   <tbody>
    <?php if (!empty($listUsers)):
    $count = 0; //STT
         foreach ($listUsers as $item):
            $count++;
    ?>
      <tr>
      <td><?php echo $count?></td>
      <td><?php echo $item['fullname']?></td>
      <td><?php echo $item['email']?></td>
      <td><?php echo $item['phone']?></td>
      <td><?php echo $item['status'] == 1 ? '<button class="btn btn-success btn-sm" style="width: 55%;">Đã Kích Hoạt</button>' : '<button class="btn btn-danger btn-sm">Chưa Kích Hoạt</button>' ?></td>
      <td><?php echo $item['role'] == 1 ? '<button class="btn btn-success btn-sm" style="width: 55%;">User</button>' : '<button class="btn btn-danger btn-sm">Admin</button>' ?></td>
      <td><a href="<?php echo _WEB_HOST;?>?module=users&action=edit&id=<?php echo $item['id'];?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
      <td><a href="<?php echo _WEB_HOST;?>?module=users&action=delete&id=<?php echo $item['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có muốn xóa không????')"><i class="fa-solid fa-trash"></i></a></td>
      </tr>
    <?php 
         endforeach;
      else :
   ?>
      <tr>
         <td colspan="7">
            <div class="alert alert-danger text-center">Không có tài khoản nào đã đăng ký!!!!</div>
         </td>
      </tr>
   <?php
    endif;
    ?>
   </tbody>
   </table>
</div>
<?php
 layouts('footers/footer')
?>