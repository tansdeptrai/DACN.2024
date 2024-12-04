<!-- Đăng xuất -->
<?php
 if (isLogin()) {
   $token = getSession('logintoken');
   $condition = "token = '$token'";
   delete('logintoken', $condition);
   removeSession('logintoken');
   redirect('?module=auth&action=login');
 }