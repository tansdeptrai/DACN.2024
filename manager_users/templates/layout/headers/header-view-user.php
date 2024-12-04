<?php
 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
 }
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
 <body>
 <header class="pt-3 pb-3 border-bottom header">
    <div class="container-pro" style="margin: 10px 150px 20px 150px;">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="?module=home&action=home" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <img style="height: 40px;" src="data:image/png;base64,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" alt="" srcset="">
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 fs-5 fw-bolder">
          <li><a href="?module=home/pageHome&action=men" class="nav-link px-3 link-dark">NAM</a></li>
          <li><a href="#" class="nav-link px-3 link-dark">NỮ</a></li>
          <li><a href="#" class="nav-link px-3 link-dark">TRẺ EM</a></li>
          <li><a href="#" class="nav-link px-3 link-dark">SẢN PHẨM MỚI</a></li>
          <li><a href="#" class="nav-link px-3 link-dark">LIÊN HỆ</a></li>
        </ul>
        <div class="d-flex linkHeader">
          <a href="?module=home&action=carts" style="text-decoration: none; color:black;">
            <svg style="margin-left: 10px;"  xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708"/>
            </svg>
            <p style="color: gray; font-size: 12px; text-align: center;"> Giỏ hàng</p>
          </a>
          <!--  -->
          <a href="
            <?php 
              if (!isLogin()) {
                echo '?module=auth&action=login';
              }else {
                echo '?module=home&action=account';
              }
            ?>
          "  style="text-decoration: none; color:black; margin-left:20px;">
            <svg style="margin-left: 10px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
            <p style="color: gray; font-size: 12px; text-align: center;">Tài khoản</p>
          </a>
          <!--  -->
          <a href=""  style="text-decoration: none; color:black; margin-left: 20px;">
            <svg style="margin-left: 10px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
              <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
            </svg>
            <p style="color: gray; font-size: 12px; text-align: center;">Yêu thích</p>
          </a>
        </div>
      </div>
    </div>
  </header>
 </body>
 </html>
 