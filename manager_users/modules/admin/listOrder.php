<?php
 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
 }
// 

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
<div class="container-main" style="margin-top: 90px;">
    <h1>Quản Lý Đơn Hàng</h1>
    <div class="row mt-5">
        <div class="col col-lg-2">
            <div style="border: 2px solid gray; border-radius: 5px; padding: 10px;">
                    <div class="d-flex">
                        <a href="?module=admin/actionOrderAdmin&action=allListOrder" id="loadOrder" style="width: 100%;">
                        <button class="btn-order" style=" background-color: pink; color: black;">Tất Cả</button>
                        </a>
                    </div>
               
                <div class="d-flex link-order">
                    <a href="#?module=admin/actionOrderAdmin&action=cxn" style="width: 100%;">
                    <button class="btn-order" style=" background-color: lightgoldenrodyellow; color: black;">Chờ xác nhận</button>
                    </a>
                </div>
                <div class="d-flex link-order">
                    <a href="#?module=admin/actionOrderAdmin&action=dxn" style="width: 100%;">
                    <button class="btn-order" style="background-color: lightcyan; color:black;">Đã Xác Nhận</button>
                    </a>
                </div>
                <div class="d-flex link-order" style="width: 100%;">
                    <a href="#?module=admin/actionOrderAdmin&action=cvc" style="width: 100%;">
                    <button class="btn-order" style="background-color: coral; color:black;">Chờ Vận Chuyển</button>
                    </a>
                </div>
                <div class="d-flex link-order" style="width: 100%;">
                    <a href="#?module=admin/actionOrderAdmin&action=dvc" style="width: 100%;">
                    <button class="btn-order" style="background-color: lightgreen;">Đang Vận Chuyển</button>
                    </a>
                </div>
                <div class="d-flex link-order">
                    <a href="#?module=admin/actionOrderAdmin&action=dgh" style="width: 100%;">
                    <button class="btn-order" style="background-color: greenyellow;">Đã Giao Hàng</button>
                    </a>
                </div>
                <div class="d-flex link-order" style="width: 100%;">
                    <a href="#?module=admin/actionOrderAdmin&action=hdh" style="width: 100%;">
                    <button class="btn-order" style="background-color: red; color: white;">Hủy Đơn Hàng</button>
                    </a>
                </div>
                <div class="d-flex link-order" style="width: 100%;">
                    <a href="#?module=admin/actionOrderAdmin&action=hth" style="width: 100%;">
                    <button class="btn-order" style="background-color: blueviolet;">Hoàn - Trả Hàng</button>
                    </a>
                </div>
            </div>
        </div>
        <div  class="col">
                
            <div id="contentListOrderAdmin" style="border: 2px solid gray; border-radius: 5px; padding:10px;">
                
            </div>
        </div>
    </div>
</div>
<script>
        // load page
            $(document).ready(function() {
                const firstPageUrl = $('#loadOrder').attr('href');
                if (window.location.href !== firstPageUrl) {
                    $("#contentListOrderAdmin").load("?module=admin/actionOrderAdmin&action=allListOrder");
                }
            });
            $("#loadOrder").click(function (e) { 
                e.preventDefault();
                $("#contentListOrderAdmin").load("?module=admin/actionOrderAdmin&action=allListOrder");
            });
            //
            $(".link-order").on("click", "a", function () {
                var hrf = $(this).attr("href");
                var link = hrf.substring(1,hrf.length);
                $("#contentListOrderAdmin").load(link);
            });
</script>
<?php
layouts('footers/footer');
 
