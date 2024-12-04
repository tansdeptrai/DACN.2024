<!-- Tính năng đăng nhập tài khoản -->
<?php
 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
 }
$data = [
   'pageTitle' => 'Đăng nhập tài khoản',
];
 layouts('headers/header-login', $data);
  //Kiểm tra trạng thái đăng nhập
  if (isLogin()) {
     redirect('?module=home&action=dasboard');
  }
if (isPost()) {
   $filterAll = filter();
   if (!empty(trim($filterAll['email'])) && !empty(trim($filterAll['password']))) {
      //Kiểm tra đăng nhập
      $email = $filterAll['email'];
      $password = $filterAll['password'];
      //Truy vấn lấy thông tin users theo email
      $userQuery = oneRaw("SELECT id, role, password FROM users WHERE email = '$email'");
      if (!empty($userQuery)){
         $passwordHash = $userQuery['password'];
         $user_id = $userQuery['id'];
         if (password_verify($password, $passwordHash)) {
            //tạo token login
            $tokenLogin = sha1(uniqid().time());
            // Insert vào bảng logintoken
            $dataInsert = [
               'user_ID'=>$user_id,
               'token'=>$tokenLogin,
               'create_at'=> date('Y-m-d H:i:s')
            ];
            $insertStatus = insert('logintoken', $dataInsert);
            if ($insertStatus) {
               //Lưu login token vào session
               setSession('logintoken',$tokenLogin);
               if ($userQuery['role'] == 0) {
                  redirect('?module=home&action=dasboard');
               }else {
                  redirect('?module=home&action=home');
               }
            }else {
               setFlashData('msg', 'Không thể đăng nhập');
               setFlashData('msg_type', 'danger');
            }
            
         }else {
            setFlashData('msg', 'Vui lòng kiểm tra lại  mật khẩu!!');
            setFlashData('msg_type', 'danger');
            redirect('?module=auth&action=login');
         }
      }else {
         setFlashData('msg', 'Vui lòng kiểm tra lại Email và Mật khẩu');
         setFlashData('msg_type', 'danger');
         redirect('?module=auth&action=login');
      }
   }else {
      setFlashData('msg', 'Vui lòng nhập Email và Mật khẩu');
      setFlashData('msg_type', 'danger');
      redirect('?module=auth&action=login');
   }
}
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');


?>
 <div class="row">
   <div class="col-4" style="margin: 50px auto;">
      <h2 class="text-center text-uppercase">ĐĂNG NHẬP QUẢN LÝ USER</h2>
      <?php 
        if(!empty($msg)){
          getSmg($msg, $msg_type);
        }
      ?>
      <form action="" method="post">
         <div class="form-group mg-form">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Địa chỉ email">
         </div>
         <div class="form-group mg-form">
         <label for="">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
         </div>
         <button type="submit" class="btn btn-primary btn-block mg-btn">Đăng Nhập</button>
         <hr>
         <p class="text-center"><a href="?module=auth&action=forgot">Quên mật khẩu</a></p>
         <p class="text-center"><a href="?module=auth&action=resigin">Đăng ký tài khoản</a></p>
      </form>
   </div>
 </div>
 <?php
layouts('footers/footer-login');
 ?>