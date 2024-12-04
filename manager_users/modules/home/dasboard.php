<?php
 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
 }
 $data = [
   'pageTitle' => 'Trang Chủ - ADMIN',
];
 layouts('headers/header', $data);
//  Kiểm tra trạng thái đăng nhập
if (!isLogin()) {
   redirect('?module=auth&action=login');
};
?>
<!-- Body HTML -->
<h1>Dasboard</h1>
<?php
layouts('footers/footer');
 
