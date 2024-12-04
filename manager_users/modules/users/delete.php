<h1>hihi đây là xóa nha</h1>
<?php
 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
 }
 //Kiểm tra id trong database -> tồn tại -> tiến hành xóa
 //Xóa dữ liệu ở bảng logintoken -> xóa dữ liệu ở bảng users
 $filterAll = filter();
 if (!empty($filterAll['id'])) {
   $user_Id = $filterAll['id'];
   $userDetail = getRows("SELECT * FROM users WHERE id = $user_Id");
   if ($userDetail > 0) {
      //Thực Hiện xóa
      $deleteToken = delete('logintoken', "user_ID=$user_Id");
      if ($deleteToken) {
         $deleteUser = delete('users', "id=$user_Id");
         if ($deleteUser) {
            setFlashData('smg', 'Đã xóa tài khoản');
            setFlashData('smg_type', 'success');
         }else {
            setFlashData('smg', 'Xóa không thành công.');
            setFlashData('smg_type', 'danger');
         }
      }
   }else {
      setFlashData('smg', 'Tài Khoản không tồn tại.');
      setFlashData('smg_type', 'danger');
   }
 }else {
   setFlashData('smg', 'Liên kết không tồn tại.');
   setFlashData('smg_type', 'danger');
 }
 
 redirect('?module=users&action=list');