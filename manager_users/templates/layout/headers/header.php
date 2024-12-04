<?php
//  if (!defined('_CODE')) { // check _code có tồn tại không
//     die('Access denied...');
//  }
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'Quản Lý Người Dùng' ?></title>
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/style.css?ver=<?php echo rand() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 </head>
 <body>
 <header class="p-3  border-bottom header">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <img style="height: 40px;" src="data:image/png;base64,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" alt="" srcset="">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="?module=users&action=list" class="nav-link px-2 link-dark">Tài Khoản</a></li>
          <li><a href="?module=colors_sizes&action=list" class="nav-link px-2 link-dark">Biến Thể</a></li>
          <li><a href="?module=products&action=list" class="nav-link px-2 link-dark">Sản Phẩm</a></li>
          <li><a href="?module=colors_sizes/variantProduct&action=list" class="nav-link px-2 link-dark">Sản Phẩm Trong Kho</a></li>
          <li><a href="?module=admin&action=listOrder" class="nav-link px-2 link-dark">Đơn Hàng</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://i.pinimg.com/236x/89/b2/02/89b20232ddd0c8dfe134ff0e6d376e67.jpg" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Cài đặt</a></li>
            <li><a class="dropdown-item" href="#">Thông Tin</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="?module=auth&action=logout">Đăng Xuất</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
 </body>
 </html>
 