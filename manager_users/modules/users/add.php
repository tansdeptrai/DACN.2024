<!-- Tính năng đăng nhập tài khoản -->
<?php
 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
 }
 if (isPost()) {
    $filterAll = filter();
   
    $erros=[]; //Mảng chứa các lỗi

    if (empty($filterAll['fullname'])) {
      $erros['fullname']['required'] = 'Họ tên không được để trống';
    }else{
      if (strlen($filterAll['fullname']) < 5) {
         $erros['fullname']['min'] = 'Họ tên phải lớn hơn 5 ký tự';
      }
    }
    //email
    if (empty($filterAll['email'])) {
      $erros['email']['required'] = 'Email không được để trống';
    }else {
      $email = $filterAll['email'];
      $sql = "SELECT id FROM users WHERE email = '$email'";
      if (getRows($sql) > 0) {
         $erros['email']['unique'] = 'Email đã được sử dụng';
      }
    }
    //Phone
    if (empty($filterAll['phone'])) {
      $erros['phone']['required'] = 'Số điện thoại không được để trống';
    }else{
      if(!isPhone($filterAll['phone'])){
      $erros['phone']['isPhone'] = 'Số điện thoại không hợp lệ';
      }
    }
    //password
    if (empty($filterAll['password'])) {
      $erros['password']['required'] = 'Mật khẩu không được để trống';
    }else{
      if (strlen($filterAll['password']) < 8) {
      $erros['phone']['min'] = 'Mật khẩu phải lớn hơn 8 ký tự';
      }
    }
    //Password_Confirm
    if (empty($filterAll['password_confirm'])) {
      $erros['password_confirm']['required'] = 'Mật khẩu không được để trống';
    }else{
      if (($filterAll['password']) != ($filterAll['password_confirm'])) {
      $erros['password_confirm']['match'] = 'Mật khẩu nhập lại không đúng';
      }
    }
   if(empty($erros)){
    $dataInsert = [
      'fullname' => $filterAll['fullname'],
      'email' => $filterAll['email'],
      'phone'=> $filterAll['phone'],
      'password'=> password_hash($filterAll['password'], PASSWORD_DEFAULT),
      'status' => $filterAll['status'],
      'create_at' => date('Y-m-d H:i:s')
    ];
    $insertStatus = insert('users', $dataInsert);
    if ($insertStatus) {
      setFlashData('smg', 'Thêm tài khoản thành công! , vui lòng check email để kích hoạt tài khoản');
      setFlashData('smg_type', 'success');
      redirect('?module=users&action=add');

    }else{
      setFlashData('smg', 'Thêm mới tài khoản không thành công!!!');
      setFlashData('smg_type', 'danger');
    }
    redirect('?module=users&action=add');
  }else {
    setFlashData('smg', 'Vui Lòng Kiểm Tra Lại Dữ Liệu!!');
    setFlashData('smg_type', 'danger');
    setFlashData('erros',$erros);
    setFlashData('old', $filterAll);
    redirect('?module=users&action=add');
  }
 };
 
 $data = [
   'pageTitle' => 'Thêm mới tài khoản',
];
 layouts('headers/header-login', $data);
    $smg = getFlashData('smg');
    $smg_type = getFlashData('smg_type');
    $erros = getFlashData('erros');
    $old = getFlashData('old');
 ?>
 <div class="container">
   <div class="row" style="margin: 50px auto;">
      <h2 class="text-center text-uppercase">Thêm  Tài Khoản User</h2>
      <?php 
        if(!empty($smg)){
          getSmg($smg, $smg_type);
        }
      ?>
      <form action="" method="post">
         <div class="row">
            <div class="col">
                <div class="form-group mg-form">
                  <label for="">Họ Tên:</label>
                  <input type="text" class="form-control" name="fullname" placeholder="Họ Tên" value="<?php echo oldData('fullname', $old); ?>">
                  <?php 
                  echo form_erros('fullname', '<span class = "erros">','</span>', $erros);
                  ?>
               </div>
               <div class="form-group mg-form">
                  <label for="">Email:</label>
                  <input type="email" class="form-control" name="email" placeholder="Địa chỉ email" value="<?php echo oldData('email', $old); ?>">
                  <?php 
                  echo form_erros('email', '<span class = "erros">','</span>', $erros);
                  ?>
               </div>
               <div class="form-group mg-form">
                  <label for="">Số Điện Thoại:</label>
                  <input type="number" class="form-control" name="phone"  placeholder="Số Điện Thoại" value="<?php echo oldData('phone', $old);?>">
                  <?php 
                  echo form_erros('phone', '<span class = "erros">','</span>', $erros);
                  ?>
               </div>
            </div>
            <div class="col">
               <div class="form-group mg-form">
                  <label for="">Password:</label>
                  <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                  <?php 
                  echo form_erros('password', '<span class = "erros">','</span>', $erros);
                  ?>
               </div>
               <div class="form-group mg-form">
                  <label for="">Nhập Lại Password:</label>
                  <input type="password" name="password_confirm" class="form-control" placeholder="Nhập Lại Mật Khẩu">
                  <?php 
                  echo form_erros('password_confirm', '<span class = "erros">','</span>', $erros);
                  ?>
               </div>
               <div class="form-group">
                  <label for="">Trạng thái</label>
                  <select name="status" id="" class="form-control">
                     <option value="0" <?php echo oldData('status', $old)==0 ? 'selected' : false; ?>>Chưa Kích Hoạt</option>
                     <option value="1" <?php echo oldData('status', $old)==1 ? 'selected' : false; ?>>Đã Kích Hoạt</option>
                  </select>
               </div>
            </div>
         </div>
         <button type="submit" class="btn btn-primary btn-block mg-btn mt-4">Đăng Ký</button>
         <hr>
         <p class="text-center"><a href="?module=users&action=list">Quay Lại</a></p>
      </form>
   </div>
 </div>
 <?php
layouts('footers/footer-login');
 ?>