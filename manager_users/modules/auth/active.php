<!-- Kích hoạt tài khoản -->
<?php
 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
 }
 layouts('header-login');
 $token = filter()['token'];
 if (!empty($token)) {
   $tokenQuery = oneRaw("SELECT id FROM users WHERE ativeToken = '$token'");
   if (!empty($tokenQuery)) {
      $userId = $tokenQuery['id'];
      $dataUpdate = [
         'status' =>1,
         'ativeToken' =>null
      ];

      $updateStatus = update('users', $dataUpdate, "id=$userId");
      if ($updateStatus) {
         setFlashData('msg', 'Tài khoản kích hoạt thành công!!');
         setFlashData('msg_type', 'success');
      }
      else {
         setFlashData('msg', 'Kích hoạt tài khoản thất bại!!');
         setFlashData('msg_type', 'danger');
      }

      redirect('?module=auth&action=login');
   }else {
      getSmg('Liên kết không tồn tại', 'danger');
   }
 }else {
      getSmg('Liên kết không tồn tại hoặc đã hết hạn', 'danger');
 }
 ?>
<h2>ACTIVE</h2>
<?php
layouts('footer-login');
?>