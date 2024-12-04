<?php
if (!isLogin()) {
    redirect("?module=auth&action=login");
 }
$products = [];
foreach ($_SESSION['carts'] as $cart) {
    $products[] = getRaw("SELECT * FROM orders WHERE id = $cart");
}
//list province
$provinces = getRaw("SELECT * FROM province ");
//
 $data = [
    'pageTitle' => 'Check Out',
 ];
 layouts('headers/header-view-user', $data);
 ?>
<div style="background-color: lightgray;">
    <div class="container-main" style="margin-top: 30px; padding-top: 80px; padding-bottom: 80px;">
        <div class="row">
            <!-- BOX TRÁI -->
            <div class="col-8">
                <div class="d-flex justify-content-center" id="success-checkout"></div>
                <div style="background-color: white; height: auto; border: 1px solid lightgray; border-radius: 10px;">
                    <!-- info ship -->
                    <div class="row pt-3">
                        <!-- title -->
                        <div class="d-flex justify-content-between">
                            <div class="d-flex justify-content-start ps-3">
                                <svg style="padding-top: 5px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-map-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v14a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.5.5 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5zM5 14.09V1.11l.5-.1.5.1v12.98l-.402-.08a.5.5 0 0 0-.196 0zm5 .8V1.91l.402.08a.5.5 0 0 0 .196 0L11 1.91v12.98l-.5.1z"/>
                                </svg>
                                <p style="padding-left: 10px; font-weight: bold; font-size: 18px;">Thông tin giao hàng</p>
                            </div>
                            <div class="d-flex justify-content-start px-3">
                                <svg style="padding-top: 5px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                                <p style="padding-left: 10px; font-weight: bold; font-size: 18px;">Thay đổi</p>
                            </div>
                        </div>
                        <!-- end title -->
                        <div class="mb-3" style="padding-left: 28px; padding-right: 28px;">
                            <label  class="form-label">Họ Tên</label>
                            <input type="text" class="form-control" id="name" placeholder="Họ Và Tên" style="padding-left: 10px;">
                            <span id="name-error" style="color:red" class="error-message"></span>
                        </div>
                        <div class="mb-3" style="padding-left: 28px; padding-right: 28px;">
                            <label  class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" style="padding-left: 10px;">
                            <span id="phone-error" style="color:red" class="error-message"></span>
                        </div>
                        
                        <div class="mb-3" style="padding-left: 28px; padding-right: 28px;">
                            <label  class="form-label">Tỉnh / Thành phố</label>
                            <select id="province" class="form-select" aria-label="Default select example">
                                <option value="default">Tỉnh / Thành phố</option>
                                <?php foreach ($provinces as $p):?>
                                <option value="<?php echo $p['province_id']?>"><?php echo $p['name'];?></option>
                                <?php endforeach;?>
                            </select>
                            <span id="province-error" style="color:red" class="error-message"></span>
                        </div>
                        <div class="mb-3" style="padding-left: 28px; padding-right: 28px;">
                            <label class="form-label">Quận / Huyện</label>
                            <select id="district" class="form-select" aria-label="Default select example">
                                <option value="default">Quận / Huyện</option>
                            </select>
                            <span id="district-error" style="color:red" class="error-message"></span>
                        </div>
                        <div class="mb-3" style="padding-left: 28px; padding-right: 28px;">
                            <label  class="form-label">Phường / Xã</label>
                            <select id="wards" class="form-select" aria-label="Default select example">
                                <option value="default" >Phường / Xã</option>
                            </select>
                            <span id="wards-error" style="color:red" class="error-message"></span>
                        </div>
                        <div class="mb-3" style="padding-left: 28px; padding-right: 28px;">
                            <label  class="form-label">Nhập địa chỉ</label>
                            <input id="address" type="text" class="form-control"   placeholder="Địa chỉ chi tiết" style="padding-left: 10px;">
                            <span style="color:red;" id="address-error" class="error-message"></span>
                        </div>
                    </div>
                </div>
                     <!-- Method Ship -->
                <div class="mt-3" style="background-color: white; height: auto; border: 1px solid lightgray; border-radius: 10px;">
                     <div class="row">
                        <div class="d-flex justify-content-start ps-3">
                            <svg style="padding-top: 5px; padding-left:20px;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                            </svg>
                            <p style="padding-top: 15px; padding-left: 10px; font-weight: bold; font-size: 18px;">Phương thức giao hàng</p>
                        </div>
                        <p style="margin-left: 25px; color: gray;">Cập nhật thông tin giao hàng để xem chi phí giao và thời gian giao hàng.</p>
                    </div>
                </div>
                    <!-- Method pay -->
                <div class="mt-3" style="background-color: white; height: auto; border: 1px solid lightgray; border-radius: 10px;">
                    <div class="row">
                        <div class="d-flex justify-content-start ps-3">
                            <svg style="padding-top: 5px; padding-left:20px;" xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-wallet" viewBox="0 0 16 16">
                                <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a2 2 0 0 1-1-.268M1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1"/>
                            </svg>
                            <p style="padding-top: 15px; padding-left: 10px; font-weight: bold; font-size: 18px;">Phương thức thanh toán</p>
                        </div>
                        <span style="margin-left:40px; margin-bottom:10px; color:red;" id="pay-error" class="error-message"></span>
                        <button class="mb-4" style="background-color: whitesmoke; width: 90%; margin-left:40px; border:1px solid lightgray; border-radius:10px; margin-bottom:20px;" onclick="selectRadio('radio1')">
                            <div class="d-flex">
                                <input class="pay" style="padding-left: 20px;" type="radio" id="radio1" name="radio-group" value="0">
                                <svg style="color: black; padding-top:15px; padding-left:5px" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                                </svg>
                                <p style="color: black; padding-left:5px; padding-top: 10px;">Thanh toán khi nhận hàng</p>
                            </div>
                        </button>
                        <button class="mb-4" style="background-color: whitesmoke; width: 90%; margin-left:40px; border:1px solid lightgray; border-radius:10px; margin-bottom:20px;" onclick="selectRadio('radio2')">
                            <div class="d-flex">
                                <input class="pay" style="padding-left: 20px;" type="radio" id="radio2" name="radio-group" value="1">
                                <svg style="color: black; padding-top:10px; padding-left:5px" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                    <path d="M2 2h2v2H2z"/>
                                    <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"/>
                                    <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"/>
                                    <path d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
                                    <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z"/>
                                </svg>
                                <p style="color: black; padding-left:5px; padding-top: 10px;">Thanh toán bằng VN PAY</p>
                            </div>
                        </button>
                        <button  class="mb-4" style="background-color: whitesmoke; width: 90%; margin-left:40px; border:1px solid lightgray; border-radius:10px; margin-bottom:20px;" onclick="selectRadio('radio3')">
                            <div class="d-flex">
                                <input class="pay" style="padding-left: 20px;" type="radio" id="radio3" name="radio-group" value="2">
                                <svg  style="padding-top: 12px;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" width="40" height="40" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 362 535.3" style="enable-background:new 0 0 362 535.3;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#EA501F;}
                                        .st1{fill:#FFFFFF;}
                                    </style>
                                    <path class="st0" d="M11.2,482.1c-1.6-1.1-2.1-3.3-1-5c1.1-1.6,3.3-2.1,5-1c1,0.7,2.1,1.4,3.3,2.1c8.2,5,15.9,7.5,22.2,7.5
                                        c5.7,0,10.4-2.2,13.3-6.5v0c0.2-0.3,0.4-0.5,0.4-0.7c0.8-1.4,1.5-2.8,1.9-4.2c0.8-2.9,0.7-5.9-0.5-8.6c-1.2-2.9-3.7-5.6-7.5-7.9l0,0
                                        c-2.5-1.5-5.7-2.9-9.5-4c-9.7-2.7-16.8-6.6-20.7-11.7c-4.2-5.7-4.5-12.5,0-20.8c3-5.5,9.1-8.9,16.9-9.5c6.7-0.5,14.8,1.1,23,5.3
                                        c1.8,0.9,2.5,3.1,1.6,4.8c-0.9,1.8-3.1,2.5-4.8,1.6c-7-3.6-13.7-4.9-19.2-4.5c-5.3,0.4-9.4,2.5-11.1,5.8c-3,5.5-3,9.8-0.5,13.1
                                        c2.8,3.8,8.7,6.8,16.8,9.1c4.4,1.2,8.1,2.9,11.2,4.8h0c5.1,3.1,8.5,7,10.3,11.2c1.9,4.3,2.1,9,0.8,13.4c-0.6,2-1.5,4.1-2.7,6
                                        c-0.3,0.4-0.5,0.8-0.6,1l0,0c-4.3,6.4-11.1,9.6-19.3,9.6c-7.6,0-16.5-2.8-25.9-8.5C13.7,483.7,12.5,483,11.2,482.1z"/>
                                    <path class="st0" d="M75.1,415.2c0-1.9,1.6-3.4,3.6-3.4c2,0,3.6,1.5,3.6,3.4v74.3c0,1.9-1.6,3.4-3.6,3.4c-2,0-3.6-1.5-3.6-3.4V415.2
                                        z"/>
                                    <path class="st0" d="M82.5,461.5c-1.3,1.5-3.5,1.8-5.1,0.5c-1.5-1.3-1.8-3.5-0.5-5.1c5.5-6.7,11.7-10.8,17.8-12.6
                                        c4.4-1.3,8.7-1.4,12.4-0.4c3.9,1.1,7.3,3.3,9.7,6.7c2.3,3.2,3.6,7.3,3.6,12.2v26.6c0,2-1.6,3.6-3.6,3.6c-2,0-3.6-1.6-3.6-3.6v-26.6
                                        c0-3.4-0.8-6.1-2.2-8.1c-1.4-1.9-3.3-3.2-5.7-3.9c-2.5-0.7-5.4-0.6-8.5,0.3C92,452.6,87,456,82.5,461.5z"/>
                                    <path class="st0" d="M155.7,443.2c6.9,0,13.1,2.8,17.6,7.3l0,0c4.5,4.5,7.3,10.7,7.3,17.6c0,6.9-2.8,13.1-7.3,17.6
                                        c-4.5,4.5-10.7,7.3-17.6,7.3s-13.1-2.8-17.6-7.3v0c-4.5-4.5-7.3-10.7-7.3-17.6c0-6.9,2.8-13.1,7.3-17.6v0
                                        C142.6,446,148.9,443.2,155.7,443.2L155.7,443.2z M168.3,455.5c-3.2-3.2-7.7-5.2-12.6-5.2c-4.9,0-9.3,2-12.6,5.2l0,0
                                        c-3.2,3.2-5.2,7.7-5.2,12.6c0,4.9,2,9.4,5.2,12.6l0,0c3.2,3.2,7.7,5.2,12.6,5.2s9.3-2,12.6-5.2c3.2-3.2,5.2-7.7,5.2-12.6
                                        C173.5,463.2,171.5,458.7,168.3,455.5z"/>
                                    <path class="st0" d="M190.8,446.8c0-2,1.6-3.6,3.6-3.6c2,0,3.6,1.6,3.6,3.6v4.5c0.3-0.3,0.5-0.6,0.8-0.8v0
                                        c4.5-4.5,10.7-7.3,17.6-7.3c6.9,0,13.1,2.8,17.6,7.3l0,0c4.5,4.5,7.3,10.7,7.3,17.6c0,6.9-2.8,13.1-7.3,17.6
                                        c-4.5,4.5-10.7,7.3-17.6,7.3s-13.1-2.8-17.6-7.3v0c-0.3-0.3-0.5-0.6-0.8-0.8v32.7c0,2-1.6,3.6-3.6,3.6c-2,0-3.6-1.6-3.6-3.6V446.8
                                        L190.8,446.8z M228.9,455.5c-3.2-3.2-7.7-5.2-12.6-5.2c-4.9,0-9.3,2-12.6,5.2l0,0c-3.2,3.2-5.2,7.7-5.2,12.6c0,4.9,2,9.4,5.2,12.6
                                        l0,0c3.2,3.2,7.7,5.2,12.6,5.2c4.9,0,9.3-2,12.6-5.2c3.2-3.2,5.2-7.7,5.2-12.6C234.1,463.2,232.1,458.7,228.9,455.5z"/>
                                    <path class="st0" d="M275.1,443.2c6.1,0,11.7,2.4,15.8,6.6c3.4,3.4,4.8,6.8,6,10.4c3.1,10.1-2.8,9.7-4.6,9.7h-33.1
                                        c0.3,2.4,0.9,4.6,1.6,6.6c1.3,3.1,3.2,5.4,5.6,7c2.5,1.6,5.7,2.4,9.4,2.4c4,0,8.7-1.1,13.9-3.3c1.8-0.8,3.9,0.1,4.7,1.9
                                        s-0.1,3.9-1.9,4.7c-6,2.5-11.6,3.7-16.6,3.8c-5.1,0.1-9.6-1.1-13.3-3.5c-3.7-2.4-6.9-5.7-8.4-10.3c-3.4-10.1-3.5-20.1,5.1-29.4
                                        C263.3,445.5,269,443.2,275.1,443.2L275.1,443.2z M285.9,454.9c-2.9-2.8-6.7-4.5-10.8-4.5c-4.1,0-7.9,1.7-10.8,4.5
                                        c-2.1,2.1-3.8,4.7-4.7,7.7h31.1C289.6,459.6,288,457,285.9,454.9z"/>
                                    <path class="st0" d="M329.7,443.2c6.1,0,11.7,2.4,15.8,6.6c3.4,3.4,4.8,6.8,6,10.4c3.1,10.1-2.8,9.7-4.6,9.7h-33.1
                                        c0.3,2.4,0.9,4.6,1.6,6.6c1.3,3.1,3.2,5.4,5.6,7c2.5,1.6,5.7,2.4,9.4,2.4c4,0,8.7-1.1,13.9-3.3c1.8-0.8,3.9,0.1,4.7,1.9
                                        c0.8,1.8-0.1,3.9-1.9,4.7c-6,2.5-11.6,3.7-16.6,3.8c-5.1,0.1-9.6-1.1-13.3-3.5c-3.7-2.4-6.9-5.7-8.4-10.3
                                        c-3.4-10.1-3.5-20.1,5.1-29.4C317.9,445.5,323.6,443.2,329.7,443.2L329.7,443.2z M340.5,454.9c-2.9-2.8-6.7-4.5-10.8-4.5
                                        c-4.1,0-7.9,1.7-10.8,4.5c-2.1,2.1-3.8,4.7-4.7,7.7h31.1C344.2,459.6,342.6,457,340.5,454.9z"/>
                                    <path class="st0" d="M36.5,118.1h75.3c2.3-25.5,9.4-48.4,19.6-66.1c13.5-23.4,32.7-37.8,54.4-37.8c21.7,0,40.8,14.5,54.4,37.8
                                        c10.2,17.6,17.3,40.6,19.6,66.1H335c8.9,0,16.9,7.3,16.2,16.2L336.1,345c-1.9,26.4-18.5,41.5-42.6,41.5H78.1
                                        c-26.8,0-41-18.7-42.6-41.5L20.3,134.4C19.7,125.5,27.6,118.1,36.5,118.1L36.5,118.1z M130.6,118.1h110.2
                                        c-2.2-22.1-8.3-41.7-17-56.7C213.8,43.9,200.2,33,185.8,33c-14.5,0-28,10.9-38.2,28.5C138.9,76.4,132.9,96.1,130.6,118.1z"/>
                                    <path class="st1" d="M131.1,312.6c-3.5-2.4-4.4-7.1-2-10.6c2.4-3.5,7.1-4.4,10.6-2c2.2,1.5,4.5,3,7,4.5c17.6,10.7,33.8,16,47.3,16
                                        c12.2,0,22.1-4.6,28.4-13.9v0c0.4-0.7,0.8-1.1,0.9-1.4c1.8-2.9,3.1-6,4-9c1.8-6.2,1.5-12.6-1-18.4c-2.7-6.1-7.9-12-16-16.9l0,0
                                        c-5.4-3.3-12.1-6.2-20.2-8.4c-20.6-5.8-35.8-14-44-25c-9-12.1-9.7-26.7-0.1-44.4c6.4-11.7,19.5-19,36.1-20.3
                                        c14.3-1.1,31.5,2.3,49,11.2c3.8,1.9,5.3,6.5,3.3,10.3s-6.5,5.3-10.3,3.3c-14.9-7.6-29.1-10.5-40.9-9.6c-11.3,0.9-19.9,5.3-23.7,12.3
                                        c-6.4,11.7-6.3,20.9-1.1,27.9c6,8.1,18.5,14.4,35.9,19.3c9.4,2.7,17.4,6.1,24,10.1h0c10.9,6.6,18.2,14.9,22.1,23.9
                                        c4,9.3,4.5,19.1,1.8,28.7c-1.2,4.3-3.1,8.6-5.7,12.8c-0.6,0.9-1,1.6-1.3,2.1l0,0c-9.3,13.7-23.6,20.5-41,20.6
                                        c-16.3,0-35.3-6-55.3-18.2C136.4,316.1,133.8,314.5,131.1,312.6z"/>
                                </svg>
                                <p style="color: black; padding-left:5px; padding-top: 10px;">Thanh toán bằng ShoppePay</p>
                            </div>
                        </button>
                    </div>
                </div>
                    <!-- info product -->
                <div class="mt-3" style="background-color: white; height: auto; border: 1px solid lightgray; border-radius: 10px;">
                    <div class="d-flex justify-content-start ps-3">
                        <svg style="padding-top: 5px; padding-left:10px;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                        </svg>
                        <p style="padding-top: 15px; padding-left: 10px; font-weight: bold; font-size: 18px; font-weight:bold;">Sản Phẩm <?php 
                        $totalQuanti = 0;
                        foreach ($products as $product) {
                            foreach ($product as $p) {
                                $totalQuanti += $p['quantity']; 
                            }  
                        };?>(<?php echo $totalQuanti;?>)</p>
                    </div>
                    <!-- Product -->
                     <?php foreach ($products as $product):
                       foreach ($product as $p) :?>
                    <div class="row" style="padding-left: 30px;">
                        <div class="col-6 d-flex">
                            <img style="width: 70px; height:auto;" src="uploads/<?php echo $p['image'];?>" alt="">
                            <div>
                                <p style="padding-left: 18px; color:black; font-weight:bold;"><?php echo $p['product_name'];?></p>
                                <div class="d-flex ps-3">
                                    <p><?php 
                                        $id_color = $p['color_name'];
                                        $colors =  oneRaw("SELECT name_color FROM colors WHERE id = $id_color");
                                        foreach ($colors as $color) {
                                            echo $color;
                                        }
                                        ?></p>
                                    <p class="ps-1 px-1"> | </p>
                                    <p><?php
                                    $id_size = $p['size_name'];
                                    $sizes =  oneRaw("SELECT name_size FROM sizes WHERE id = $id_size");
                                    foreach ($sizes as $size) {
                                        echo $size;
                                    }
                                    ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <p style="font-weight: bold;"><?php 
                                echo number_format($p['price'],0,',');?> VNĐ</p>
                        </div>
                        <div class="col">
                            <p style="font-weight: bold; padding-left:22px;">Số lượng: <?php echo $p['quantity']?></p>
                        </div>
                        <input type="hidden" class="idPro" value="<?php echo $p['id'];?>">
                    </div>
                    <hr  style="width: 90%; margin: 20px auto;">
                    <?php
                        endforeach; 
                    endforeach;
                    ?>
                    <!-- EndProduct -->
                </div>
            </div>
            <!-- BOX PHẢI -->
            <div class="col-4 ps-4">
                    <!-- coupon -->
                    <div class="row">
                        <div class="pt-3" style="background-color: white; height: auto; border: 1px solid lightgray; border-radius: 10px;">
                            <div class="d-flex justify-content-between">
                                <p style="font-weight: bold;">Mã ưu đãi</p>
                                <div class="d-flex">
                                    <p>Chọn hoặc nhập mã</p>
                                    <svg style="padding-top: 6px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </div>
                            </div>
                            <hr  style="width: 90%; margin: 10px auto;">
                        </div>
                    </div>
                    <!-- Pay -->
                    <div class="row pt-4">
                        <div class="pt-3" style="background-color: white; height: auto; border: 1px solid lightgray; border-radius: 10px;">
                            <p style="font-weight: bold;">Chi tiết đơn hàng</p>
                            <div class="d-flex justify-content-between">
                                <p style="color:gray">Giá trị đơn hàng</p>
                                <p style="color:gray"><?php 
                                $totalPrice = 0;
                                foreach ($products as $product) {
                                    foreach ($product as $p) {
                                        $price = ($p['price'] * $p['quantity']);
                                        $totalPrice += $price;
                                    }
                                } 
                                echo number_format($totalPrice, 0,'');?> VNĐ</p>
                            </div>
                            <hr  style="width: 90%; margin: 10px auto;">
                            <div class="d-flex justify-content-between">
                                <p style="font-weight: bold;">Điểm KHTT</p>
                                <p>+197</p>
                            </div>
                            <hr  style="width: 90%; margin: 10px auto;">
                            <div class="d-flex justify-content-between">
                                <p style="font-weight: bold;">Tổng tiền thanh toán</p>
                                <p style="font-weight: bold;" ><?php 
                                $totalPrice = 0;
                                foreach ($products as $product) {
                                    foreach ($product as $p) {
                                        $price = ($p['price'] * $p['quantity']);
                                        $totalPrice += $price;
                                    }
                                } 
                                echo number_format($totalPrice, 0,'');?> VNĐ
                                <input type="hidden" id="totalPrice" value="<?php echo $totalPrice;?>">
                                </p>
                            </div>
                            <input type="button" class="checkOut" value="Thanh Toán" style="background-color: red; font-weight:bold; color: white; width: 100%; margin: 10px auto; border: 0px solid white; height:40px">
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>
      function selectRadio(radioId) {
            const radios = document.querySelectorAll('input[name="radio-group"]');
            radios.forEach(radio => {
                radio.checked = false;
            });

            document.getElementById(radioId).checked = true;
        }
        // lấy id_province
        $(document).ready(function() {
            $('#province').change(function() {
            var provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: 'http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=locationVN&action=id_province', 
                        type: 'POST',   
                        data: {
                            id: provinceId,     
                        },
                        success: function(data) {
                            console.log(typeof data);

                            $('#district').empty();
                            $('#district').append('<option selected>Quận / Huyện</option>');
                            if (typeof data === "string") {
                                    data = JSON.parse(data);
                                }
                                $.each(data, function(index, district) {
                                $('#district').append('<option value="' + district.district_id + '">' + district.name + '</option>');
                            });
                        },
                    });
                }
            });
        });
        // lấy id_district
        $(document).ready(function() {
            $('#district').change(function() {
            var districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        url: 'http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=locationVN&action=id_district', 
                        type: 'POST',   
                        data: {
                            id: districtId,     
                        },
                        success: function(data) {
                            console.log(typeof data);

                            $('#wards').empty();
                            $('#wards').append('<option selected>Phường / Xã</option>');
                            if (typeof data === "string") {
                                    data = JSON.parse(data);
                                }
                                $.each(data, function(index, ward) {
                                $('#wards').append('<option value="' + ward.wards_id + '">' + ward.name + '</option>');
                            });
                        },
                    });
                }
            });
        });
        // tạo mã đơn hàng
        function generateRandomText() {
            const prefix = "NHT";
            let randomNumber = '';
            for (let i = 0; i < 10; i++) {
                randomNumber += Math.floor(Math.random() * 10);
            }
            return prefix + randomNumber ;
        }
        //lấy thông tin người dùng gửi đi
        $(document).ready(function () {
            $('.checkOut').click(function (e) { 
                e.preventDefault();
                let inputName = $('#name').val();
                let inputPhone = $('#phone').val();
                let inputProvince = $('#province').val(); //id_thanhpho/tinh
                let inputDistrict = $('#district').val(); //id_quan/huyen
                let inputWards = $('#wards').val();       //id_phuong/xa
                let inputAddress = $('#address').val();
                let selectedPay = $('input[name="radio-group"]:checked').val();
                let totalPrice = $('#totalPrice').val();
                let codeCart =generateRandomText(); // mã đơn hàng
                 // Kiểm tra các trường dữ liệu có rỗng không
                let isValid = true;
                
                if (!inputName) {
                    $('#name-error').text("Vui lòng nhập tên người nhận");
                    isValid = false;
                } else {
                    $('#name-error').text("");
                }

                if (!inputPhone) {
                    $('#phone-error').text("Vui lòng nhập số điện thoại");
                    isValid = false;
                } else if (inputPhone.length !== 10 || isNaN(inputPhone)) {
                    $('#phone-error').text("Số điện thoại phải có 10 chữ số hợp lệ");
                    isValid = false;
                }else {
                    $('#phone-error').text("");
                }

                if ($('#province').val() === "default") {
                    $('#province-error').text("Vui lòng chọn tỉnh/thành phố");
                    isValid = false;
                } else {
                    $('#province-error').text("");
                }

                if ($('#district').val() === "default") {
                    $('#district-error').text("Vui lòng chọn quận/huyện");
                    isValid = false;
                } else {
                    $('#district-error').text("");
                }

                if ($('#wards').val() === "default") {
                    $('#wards-error').text("Vui lòng chọn phường/xã");
                    isValid = false;
                } else {
                    $('#wards-error').text("");
                }
                if (!inputAddress) {
                    $('#address-error').text("Vui lòng nhập địa chỉ");
                    isValid = false;
                } else {
                    $('#address-error').text("");
                }

                if (!selectedPay) {
                    $('#pay-error').text("Vui lòng chọn phương thức thanh toán");
                    isValid = false;
                } else {
                    $('#pay-error').text("");
                }
                if (inValid = true) {
                    var idPros = [];
                $('.idPro').each(function() {
                   let idPro = $(this).val();
                   idPros.push({
                    id:idPro,
                   });
                });
                $.ajax({
                    type: "POST",
                    url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=check_outs&action=add",
                    data: {
                        name:inputName,
                        phone:inputPhone,
                        province:inputProvince,
                        district:inputDistrict,
                        ward:inputWards,
                        address:inputAddress,
                        pay:selectedPay,
                        totalPrice:totalPrice,
                        idPros:idPros,
                        codeCart:codeCart
                    },
                    success: function (response) {
                        if (response) {
                            $('#success-checkout').append('<button style=" color:#00FF00;border: 1px; background-color:white; border-radius:10px; margin-bottom:10px;">'
                            + response +
                            '</button>');
                            const delayTime = 4000; //4s 

                            setTimeout(function() {
                                window.location.href = "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=home&action=home"; 
                            }, delayTime);
                        }
                    }
                });
                } 
            });
        });


</script>

 <?php
layouts('footers/footer-view-user')
?>