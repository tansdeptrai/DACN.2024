<!-- Quên mật khẩu -->
  <?php
 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
 }
$data = [
   'pageTitle' => 'Khôi phục tài khoản',
];
 layouts('header-login', $data);
  //Kiểm tra trạng thái đăng nhập
  if (isLogin()) {
     redirect('?module=home&action=dasboard');
  }
  if (isPost()) {
      $filterAll = filter();
      if (!empty($filterAll['email'])) {
         $email = $filterAll['email'];
         $queryUser = oneRaw("SELECT id FROM users WHERE email = '$email'");
        if (!empty($queryUser)) {
            $user_Id = $queryUser['id'];
            //tạo forgotToken
            $forgotToken = sha1(uniqid().time());
            $dataUpdate = [
               'fogotToken' => $forgotToken
            ];
            $updateStatus = update('users', $dataUpdate, "id=$user_Id");
            if ($updateStatus) {
               //tạo link reset password
               $linkReset = _WEB_HOST . '?module=auth&action=reset&token='.$forgotToken;
               // Gửi mail cho người dùng
               $subject = 'Yêu cầu khôi phục mật khẩu.';
               $content = 'Chào bạn.<br>';
               $content .= 'Chúng tôi nhận được thôn tin yêu cầu khôi phục tài khoản của bạn. Vui lòng truy cập vào liên kết sau để khôi phục mật khẩu:<br>';
               $content .= $linkReset;
               $sendEmail = sendMail($email, $subject, $content);
               if ($sendEmail) {
                  setFlashData('msg', 'Liên kết đã được gửi');
                  setFlashData('msg_type', 'success');
               }else{
                  setFlashData('msg', 'Hệ thống đang lỗi vui lòng thử lại');
                  setFlashData('msg_type', 'danger');
               }
            }else{
               setFlashData('msg', 'Hệ thống đang lỗi vui lòng thử lại');
               setFlashData('msg_type', 'danger');
            }
        }
        else {
         setFlashData('msg', 'Địa chỉ Email không tồn tại');
         setFlashData('msg_type', 'danger');
        }
      }else{
         setFlashData('msg', 'Vui lòng nhập địa chỉ email!!');
         setFlashData('msg_type', 'danger');
      }
      redirect('?module=auth&action=forgot');
  }
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');


?>
 <div class="row">
   <div class="col-4" style="margin: 50px auto;">
      <h2 class="text-center text-uppercase">Khôi Phục Tài Khoản</h2>
      <?php 
        if(!empty($msg)){
          getSmg($msg, $msg_type);
        }
      ?>
      <form action="" method="post">
         <div class="form-group mg-form">
            <label for="">Địa Chỉ Email Khôi Phục:</label>
            <input type="email" class="form-control" name="email" placeholder="Địa chỉ email">
         </div>
         <div class="form-group mg-form">
         <button type="submit" class="btn btn-primary btn-block mg-btn">Nhận Liên Kết</button>
         <hr>
         <p class="text-center"><a href="?module=auth&action=login">Đăng Nhập</a></p>
      </form>
   </div>
 </div>
 <?php
layouts('footer-login');
 ?>