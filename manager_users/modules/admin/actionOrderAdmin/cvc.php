<!-- <h1>Chờ vận chuyển</h1> -->
 <!-- Chờ xác nhận -->
<?php
    $listOrders = getRaw("SELECT * FROM carts WHERE status = '2'");
    $groupedOrders = [];
    foreach ($listOrders as $order) {
        $code = $order['code_carts'];
        if (!isset($groupedOrders[$code])) {
            $groupedOrders[$code] = [];
        }
        $groupedOrders[$code][] = $order;
    }
    if (empty($listOrders)) {
        $message = "Không có đơn hàng nào chờ vận chuyển !!!";
    }else {
        $message = '';
    }
?>
                <div>
                    <h3>Đơn hàng</h3>
                </div>
                <span style="color:red"><?php echo $message;?></span>
                <?php foreach ($groupedOrders as $orders) :
                    foreach ($orders as $order) :
                ?>
                <div class="row p-3">
                    <div style="border: 2px solid gray; border-radius: 5px; padding:10px;">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <span style="font-weight: bold; font-size: 18px; margin-top:5px;">Online</span>
                                <?php 
                                    $id_cart = $order['code_carts'];
                                ?>
                                <select style="margin-left: 20px;" class="form-select sOrderAdmin" data-index="<?php echo $id_cart;?>">
                                    <option selected>Trạng Thái Đơn Hàng</option>
                                    <option value="0">Chờ xác nhận</option>
                                    <option value="1">Đã xác nhận</option>
                                    <option value="2">Chờ vận chuyển</option>
                                    <option value="3">Đang vận chuyển</option>
                                    <option value="4">Đã giao hàng</option>
                                    <option value="5">Hoàn - Trả hàng</option>
                                    <option value="6">Hủy đơn hàng</option>
                                </select>
                            </div>
                            <div id="mess">
                                <!--Đưa ra thông báo sau khi thay đổi trạng thái  -->
                            </div>
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
                            <button style="background-color: <?php echo $bg;?>; border-radius:8px;"><?php echo $mess;?></button>
                        </div>
                        <hr>
                        <div>

                            <div class="row mb-3">
                                <div class="col" style="color:gray;">Người Đặt Hàng:</div>
                                <div class="col" style="font-weight: bold;">
                                    <?php 
                                         $id_user = $order['id_user'];
                                         $user = oneRaw("SELECT fullname FROM users WHERE id = $id_user");
                                         foreach ($user as $u) {
                                             echo $u;
                                         }
                                    ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col" style="color:gray;">Mã Đơn Hàng:</div>
                                <div class="col" style="font-weight: bold;"><?php echo $order['code_carts']?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col" style="color:gray;">Ngày Đặt Hàng:</div>
                                <div class="col" style="font-weight: bold;"><?php echo $order['create_at']?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col" style="color:gray;">Tổng Tiền:</div>
                                <div class="col" style="font-weight: bold;"><?php echo number_format($order['total_price'],0,',')  . 'VNĐ';?></div>
                            </div>
                            <div class="row">
                                <div class="col" style="color:gray;">Chi tiết</div>
                                <div class="col" style="text-align: right; padding-right: 20px; padding-bottom: 10px;">
                                    <?php 
                                    $collapseId = "collapseExample" . $order['code_carts'];
                                    ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId;?>" aria-expanded="false" aria-controls="<?php echo $collapseId?>">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                                    </svg>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <?php 
                    break;
                    endforeach;
                endforeach;
                ?>
                 <script>
                      $(document).ready(function () {
                        $(".sOrderAdmin").change(function (e) { 
                            e.preventDefault();
                            var option = $(this).val();
                            var id = $(this).data("index");
                            $.ajax({
                                type: "POST",
                                url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=admin/actionOrderAdmin&action=changeStatusOrder",
                                data: {
                                    status:option,
                                    code_carts:id,
                                },
                                dataType: "dataType",
                                success: function (response) {
                                    $('#mess').append('<p style=" color:#00FF00;">' + response + '</p>'); 
                                }
                            });
                            
                            
                        });
                    });
                </script>