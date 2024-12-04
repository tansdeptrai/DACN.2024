<?php 
  $token = getSession('logintoken');
  $id_user = oneRaw("SELECT user_ID FROM logintoken WHERE token = '$token'");
  $user_id = $id_user['user_ID'];
  $user = oneRaw("SELECT fullname FROM users WHERE id =$user_id");

 $data = [
    'pageTitle' => 'Tài Khoản',
 ];
 layouts('headers/header-view-user', $data);
 ?>
<div style="background-color: #E8E8E8; margin-top: 80px;">
    <div class="container-main">
        <div class="link-account">
            <a href="">Trang Chủ</a>
            <div class="vertical-line"></div>
            <a href="">Tài Khoản</a>
        </div>
        <div class="row" style="padding-top:30px;">
            <div class="col-4">
                <div class="box-left-acc">
                    <!-- avata & name & class card -->
                    <div class="row pb-3">
                            <div class="d-flex justify-content-center pt-4">
                                <img class="avata-acc" src="data:image/jpeg;base64,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" alt="">
                            </div>
                            <div class="d-flex justify-content-center pt-3 pb-2">
                                <span class="name-acc"><?php echo $user['fullname'];?></span>
                                <a href="?module=account&action=user"  id="loadUser">
                                    <svg  xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="class-card">
                                    <div class="d-flex justify-content-between">
                                        <span>Hạng thẻ</span>
                                        <span>KHTT</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span style="font-weight: bold;">GREEN</span>
                                        <span style="font-weight: bold;">0</span>
                                    </div>
                                    <hr style="height:4px;border-width:0;color:whitesmoke;background-color:gray;border-radius: 5px;">
                                    <div class="d-flex justify-content-between pb-3">
                                        <div class="d-flex">
                                            <span>0</span>
                                            <span style="padding-left: 5px; padding-right: 5px;">/</span>
                                            <span>200</span>
                                        </div>
                                        <span>Gold</span>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- liên kết tùy chọn -->
                    <div class="row" id="link-acc">
                        <!-- coupon -->
                        <div class="load-acc">
                            <a href="#?module=account&action=coupon" class="d-flex">
                                <svg  xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-ticket-perforated-fill" viewBox="0 0 16 16">
                                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4-1v1h1v-1zm1 3v-1H4v1zm7 0v-1h-1v1zm-1-2h1v-1h-1zm-6 3H4v1h1zm7 1v-1h-1v1zm-7 1H4v1h1zm7 1v-1h-1v1zm-8 1v1h1v-1zm7 1h1v-1h-1z"/>
                                </svg>
                                <p>Mã ưu đãi</p>
                            </a>
                        </div>
                        <!-- oders -->
                        <div class="load-acc">
                            <a href="#?module=account&action=orders" class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                            </svg>
                                <p>Đơn hàng</p>
                            </a>
                        </div>
                        <!-- card member -->
                        <div class="load-acc">
                            <a href="#?module=account&action=cardMember" class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-credit-card-fill" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1"/>
                            </svg>
                                <p>Thẻ thành viên</p>
                            </a>
                        </div>
                        <!-- note address -->
                        <div class="load-acc">
                            <a href="#?module=account&action=listAdrress" class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-clipboard2-fill" viewBox="0 0 16 16">
                                <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                <path d="M3.5 1h.585A1.5 1.5 0 0 0 4 1.5V2a1.5 1.5 0 0 0 1.5 1.5h5A1.5 1.5 0 0 0 12 2v-.5q-.001-.264-.085-.5h.585A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1"/>
                            </svg>
                                <p>Sổ địa chỉ</p>
                            </a>
                        </div>
                        <!-- love product -->
                        <div class="load-acc">
                            <a href="#?module=account&action=loveProduct" class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                            </svg>
                                <p>Yêu thích</p>
                            </a>
                        </div>
                        <!-- recently viewed -->
                        <div class="load-acc">
                            <a href="#?module=account&action=recentlyProduct" class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg>
                                <p>Đã xem gần đây</p>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <!-- logout -->
                        <div class="load-acc">
                            <a href="?module=auth&action=logout" class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                            </svg>
                                <p>Đăng Xuất</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="box-right-acc"  id="contentAcc"></div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
    const firstPageUrl = $('#loadUser').attr('href');
    if (window.location.href !== firstPageUrl) {
        $("#contentAcc").load("?module=account&action=user");
    }
    });
    $("#loadUser").click(function (e) { 
        e.preventDefault();
        $("#contentAcc").load("?module=account&action=user");
    });
    //
    $("#link-acc").on("click", "a", function () {
        var hrf = $(this).attr("href");
        var link = hrf.substring(1,hrf.length);
        $("#contentAcc").load(link);
    });
    
</script>
<?php
layouts('footers/footer-view-user');
