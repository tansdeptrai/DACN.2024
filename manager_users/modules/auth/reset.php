<!-- Reset Password -->
<?php
 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
 }
layouts('header-login');
 $token = filter()['token'];
 if (!empty($token)) {
   $tokenQuery = oneRaw("SELECT id, fullname, email FROM users WHERE fogotToken = '$token'");
   if ($tokenQuery) {
      $user_Id = $tokenQuery['id'];
      if (isPost()) {
         $filterAll = filter();
         $erros = [];
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
           //Xử lý update password
           $passwordHash = password_hash($filterAll['password'], PASSWORD_DEFAULT);
           $dataUpdate = [
            'password'=> $passwordHash,
            'fogotToken'=> null,
            'update_at'=> date('Y-m-d H:i:s')
           ];
           $updateStatus = update('users',$dataUpdate,"id='$user_Id'");
           if ($updateStatus) {
            setFlashData('msg', 'Đổi mật khẩu thành công!!');
            setFlashData('msg_type', 'success');
            redirect('?module=auth&action=login');
           }else {
            setFlashData('msg', 'Đổi mật khẩu không thành công!!');
            setFlashData('msg_type', 'danger');
           }
         
          }else {
            setFlashData('msg', 'Vui Lòng Kiểm Tra Lại Dữ Liệu!!');
            setFlashData('msg_type', 'danger');
            setFlashData('erros',$erros);
            redirect('?module=auth&action=reset&token='.$token);
          }
      }
      $msg = getFlashData('msg');
      $msg_type = getFlashData('msg_type');
      $erros = getFlashData('erros');
?>
<!-- Form đặt lại mật khẩu -->
<div class="row">
   <div class="col-4" style="margin: 50px auto;">
      <h2 class="text-center text-uppercase">Khôi Phục Tài Khoản</h2>
      <?php 
        if(!empty($smg)){
          getSmg($smg, $smg_type);
        }
      ?>
      <form action="" method="post">
         <div class="form-group mg-form">
            <label for="">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
            <?php 
              echo form_erros('password', $erros, '<span class = "erros">','</span>');
            ?>
         </div>
         <div class="form-group mg-form">
            <label for="">Nhập Lại Password:</label>
            <input type="password" name="password_confirm" class="form-control" placeholder="Nhập Lại Mật Khẩu">
            <?php 
              echo form_erros('password_confirm', $erros, '<span class = "erros">','</span>');
            ?>
         </div>
         <input type="hidden" name="token" value="<?php echo $token;?>">
         <button type="submit" class="btn btn-primary btn-block mg-btn">Lưu Thông Tin</button>
         <hr>
         <p class="text-center"><a href="?module=auth&action=login">Đăng nhập tài khoản</a></p>
      </form>
   </div>
 </div>
<?php
   }else {
      getSmg('Liên kết không tồn tại hoặc đã hết hạn');
   }
 }else {
   getSmg('Liên kết không tồn tại hoặc đã hết hạn');
 }
 layouts('footer-login');
 ?>