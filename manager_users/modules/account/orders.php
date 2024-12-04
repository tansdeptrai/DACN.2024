<?php
$token = getSession('logintoken');
$id_user = oneRaw("SELECT user_ID FROM logintoken WHERE token = '$token'");
$user_id = $id_user['user_ID'];
$dataOrders = getRaw("SELECT *  FROM carts WHERE id_user = $user_id");

$groupedOrders = [];
foreach ($dataOrders as $order) {
    $code = $order['code_carts'];
    if (!isset($groupedOrders[$code])) {
        $groupedOrders[$code] = [];
    }
    $groupedOrders[$code][] = $order;
}
?>




<div>
    <div id="success-checkout"></div>
    <div class="d-flex justify-content-center" id="success-editUser"></div>
    <span style="font-weight: bold; font-size: 20px;">Đơn Hàng</span>
    <?php 
        foreach ($groupedOrders as $orders):
            foreach ($orders as $order):
    ?>
    <div class="pt-3">
        <div class="list-order">
            <!--  -->
            <div class="d-flex justify-content-between mb-3">
                <span style="font-weight: bolder;">Online</span>
                <?php 
                     $bg = '';
                     $mess = '';
                     $status = $order['status'];
                     if ($status == 0) {
                         $bg = '#lightgoldenrodyellow';
                         $mess = 'Chờ xác nhận';
                     }elseif ($status == 1) {
                         $bg ='lightcyan';
                         $mess ='Đã xác nhận';
                     }elseif ($status == 2) {
                         $bg ='coral';
                         $mess ='Chờ vận chuyển';
                     }
                     elseif ($status == 3) {
                         $bg = '#33FF00';
                         $mess = 'Đang vận chuyển';
                     }elseif ($status == 4) {
                         $bg ='greenyellow';
                         $mess = 'Đã giao hàng';
                     }elseif ($status == 5) {
                         $bg = 'blueviolet';
                         $mess = 'Hoàn trả hàng';
                     }
                     else {
                         $bg = '#FF0000';
                         $mess = 'Hủy đơn hàng';
                     }
                ?>
                <div style="background-color: <?php echo $bg;?>; color:white; width: 130px; text-align: center; border: 1px solid green; border-radius: 10px;"><?php echo $mess;?></div>
            </div>
            <hr class="hr">
            <!-- Mã đơn hàng -->
            <div class="row mb-3">
                <div class="col-lg-4">
                    <span style="color: gray;">Mã Đơn Hàng:</span>
                </div>
                <div class="col">
                    <span style="color: black; font-weight:bold;"><?php echo $order['code_carts']?></span>
                </div>            
            </div>
            <!-- Ngày đặt hàng -->
            <div class="row mb-3">
                <div class="col-lg-4">
                    <span style="color: gray;">Ngày Đặt Hàng:</span>
                </div>
                <div class="col">
                    <span style="color: black; font-weight:bold;"><?php echo $order['create_at']?></span>
                </div>            
            </div>
            <!-- Tổng tiền -->
            <div class="row mb-3">
                <div class="col-lg-4">
                    <span style="color: gray;">Tổng Tiền:</span>
                </div>
                <div class="col">
                    <span style="color: black; font-weight:bold;"><?php echo number_format($order['total_price'],0,',')  . 'VNĐ';?></span>
                </div>            
            </div>
            <!--  -->
            <div class="row">
                <div class="col">
                    <span>Chi Tiết</span>
                </div>
                <div class="col">
                    <?php 
                    $collapseId = "collapseExample" . $order['code_carts'];
                    ?>
                    <p style="text-align: right;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId;?>" aria-expanded="false" aria-controls="<?php echo $collapseId?>">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </p>
                </div>
                <div class="collapse" id="<?php echo $collapseId;?>">
                    <div class="card card-body">
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <span style="color:gray">Người Nhận Hàng:</span>
                            </div>
                            <div class="col"><?php echo $order['name'];?></div>
                        </div>
                        <!-- Số điện thoại -->
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <span style="color:gray">Số Điện Thoại:</span>
                            </div>
                            <div class="col">0<?php echo $order['phone'];?></div>
                        </div>
                        <!-- tỉnh thành phố -->
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <span style="color:gray">Tỉnh / Thành Phố  :</span>
                            </div>
                            <div class="col">
                                <?php
                                    $id_province = $order['province_id']; 
                                    $province = oneRaw("SELECT name FROM province WHERE province_id = $id_province");
                                    foreach ($province as $p) {
                                        echo $p;
                                    }
                                ?>
                            </div>
                        </div>
                        <!-- quận huyện -->
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <span style="color:gray">Quận / Huyện  :</span>
                            </div>
                            <div class="col">
                                <?php
                                    $id_district = $order['district_id']; 
                                    $district = oneRaw("SELECT name FROM district WHERE district_id = $id_district");
                                    foreach ($district as $d) {
                                        echo $d;
                                    }
                                ?>
                            </div>
                        </div>
                        <!-- Phường Xã -->
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <span style="color:gray">Phường / Xã  :</span>
                            </div>
                            <div class="col">
                                <?php
                                    $id_ward = $order['ward_id']; 
                                    $ward = oneRaw("SELECT name FROM wards WHERE wards_id = $id_ward");
                                    foreach ($ward as $w) {
                                        echo $w;
                                    }
                                ?>
                            </div>
                        </div>
                        <!-- địa chỉ chi tiết -->
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <span style="color:gray">Địa chỉ chi tiết:</span>
                            </div>
                            <div class="col"><?php echo $order['address'];?></div>
                        </div>
                        <!-- phương thức thanh toán -->
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <span style="color:gray">Phương thức thanh toán:</span>
                            </div>
                            <div class="col">
                                <?php 
                                    if ($order['method_pay'] == 0) {
                                        echo 'Thanh Toán Khi Nhận Hàng.';
                                    }elseif ($order['method_pay'] == 1) {
                                        echo 'Thanh Toán VN PAY';
                                    }else{
                                        echo 'Thanh Toán Ví ShoppePay';
                                    };
                                ?>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <span style="color: gray;">Sản Phẩm:</span>
                            </div>
                            <div class="col mt-2">
                                <?php foreach ($orders as $order) :?>
                                    <div class="row mb-3">
                                        <div class=" col col-lg-2"><img style="width: 60px; height:auto;" src="uploads/<?php echo $order['image_product'];?>"></div>
                                        <div class="col">
                                            <div class="row">
                                                <span>
                                                    <?php echo $order['name_product'];?>
                                                </span>
                                                <div class="d-flex justify-content-star" style="height: 32px;">
                                                    <span style="font-size: 14px; margin-right: 5px; margin-top:2px;">
                                                        <?php 
                                                            $id_size = $order['size_product'];
                                                            $size = oneRaw("SELECT name_size FROM sizes WHERE id = $id_size");
                                                            foreach ($size as $s) {
                                                                echo $s;
                                                            };
                                                        ?>
                                                    </span>
                                                    <p style="color: gray;">|</p>
                                                    <span style="font-size: 14px; margin-left:5px; margin-top:2px;">
                                                        <?php 
                                                            $id_color = $order['color_product'];
                                                            $color = oneRaw("SELECT name_color FROM colors WHERE id = $id_color");
                                                            foreach ($color as $c) {
                                                                echo $c;
                                                            };
                                                        ?>
                                                    </span>
                                                </div>
                                                <div>
                                                <span style="font-size: 14px;">Số lượng: <?php echo $order['quantity_product'];?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                                endforeach;?>
                            </div>
                        </div>
                        <?php foreach ($orders as $order): ?>
                            <div style="text-align: right; color:red;">
                                <input type="hidden"  class="idCart" value="<?php echo $order['code_carts'];?>">
                                <svg class="destroy"  xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                </svg>
                            </div>
                
                        <?php
                         break;
                        endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        break;
        endforeach;
    endforeach;
    ?>
</div>
<script>
    $(document).ready(function () {
        $(".destroy").click(function (e) { 
            e.preventDefault();
            var confirmation = confirm("Bạn có muốn hủy đơn hàng này !!!");
            if (confirmation) {
                var idCartValue = $(this).prev('.idCart').val();
                $.ajax({
                    type: "POST",
                    url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=account/user&action=destroyOrder",
                    data: {
                        code_carts:idCartValue,
                    },
                    dataType: "dataType",
                    success: function (response) {
                        if (response) {
                            $('#success-checkout').append('<button style=" color:#00FF00;border: 1px; background-color:white; border-radius:10px; margin-bottom:10px;">'
                            + response +
                            '</button>');
                        }
                    }
                });
            }
        });
    });
</script>