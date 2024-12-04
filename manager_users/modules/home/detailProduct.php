<?php
//Truy Xuất LIST SP
$listProducts = getRaw("SELECT  vp.product_id, MIN(vp.id) AS id ,MIN(vp.image) AS image,MIN(vp.price) AS price, MAX(p.name) AS product_name
FROM variant_products vp
INNER JOIN products p ON vp.product_id = p.id GROUP BY vp.product_id ORDER BY RAND() LIMIT 4");
// 
    $listSize = getRaw("SELECT name_size FROM sizes ");
    $filterAll = filter();
    if (!empty($filterAll['id'])) {
        $pro_id = $filterAll['id'];
        $detailPro = getRaw("SELECT vp.id, vp.product_id, vp.image, vp.color_id, vp.size_id, vp.price, vp.quantity, (p.name) AS product_name, p.code_pro, (p.description) AS des_pro, p.use_pro, c.name_color, c.color_code, (c.id) AS id_color, s.name_size, (s.id) AS id_size, (d.name) AS cate_name
        FROM variant_products vp 
        INNER JOIN colors c ON vp.color_id =c.id
        INNER JOIN products p ON vp.product_id = p.id
        INNER JOIN sizes s ON vp.size_id =s.id
        INNER JOIN danhmuc d ON vp.cate_id = d.id WHERE vp.product_id = $pro_id ");
    };
    $tokenLogin = getSession('logintoken');
    $user_id = oneRaw("SELECT user_ID FROM logintoken WHERE token = '$tokenLogin'");
    $id_user = $user_id['user_ID'];
 $data = [
   'pageTitle' => 'DETAIL - PRODUCT',
];
layouts('headers/header-view-user', $data);
$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$erros = getFlashData('erros');
?>
<!-- Body HTML -->
<main>
    <div style="margin: 10px 150px 20px 150px;">
        <div class="tilte-link-header">
            <a href="">Trang Chủ</a>
            <div class="vertical-line"></div>
            <a href="">Nam</a>
            <div class="vertical-line"></div>
            <?php foreach ($detailPro as $items) :
            ?>
            <a href=""><?php echo $items['cate_name']?></a>
            <div class="vertical-line"></div>
            <span><?php echo $items['product_name']?></span>
        </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row rowDetailPro">
            <div class="boxPro-left" style="width: 600px;">
                <div  style="background-color: aqua;">
                    <img style="width: 100%;height: auto; border: 2px solid gray;" src="uploads/<?php echo $items['image'];?>" alt="" srcset="">
                    <input type="hidden" name="image" id="image" value="<?php echo $items['image'];?>">
                </div>
            </div>
            <div class="col boxPro-right">
                <div class="d-flex justify-content-between">
                    <div class="col">
                        <div style=" width: 100px;">
                        <img style="width: 100%; height:120px; margin-bottom: 15px; border: 2px solid gray;" src="https://canifa.com/img/212/284/resize/8/t/8tp24s001-sw001-1.webp" alt="" srcset="">
                        <img style="width: 100%; height:120px; margin-bottom: 15px; border: 2px solid gray;" src="https://canifa.com/img/212/284/resize/8/t/8tp24s001-sw001-1.webp" alt="" srcset="">
                        <img style="width: 100%; height:120px; margin-bottom: 15px; border: 2px solid gray;" src="https://canifa.com/img/212/284/resize/8/t/8tp24s001-sw001-1.webp" alt="" srcset="">
                        <img style="width: 100%; height:120px; margin-bottom: 15px; border: 2px solid gray;" src="https://canifa.com/img/212/284/resize/8/t/8tp24s001-sw001-1.webp" alt="" srcset="">
                        <img style="width: 100%; height:120px; margin-bottom: 15px; border: 2px solid gray;" src="https://canifa.com/img/212/284/resize/8/t/8tp24s001-sw001-1.webp" alt="" srcset="">
                        </div>
                    </div>
                    <div style="margin-left: 25px;">
                        <div style="width: 470px;">
                            <span style="font-weight: bolder; font-size: 28px; color: black">
                                <?php echo $items['product_name'];?>
                                <input type="hidden" name="product_name" id="product_name" value="<?php echo $items['product_name'];?>">
                            </span>
                            <span class="d-flex mt-2">
                                <p style="color: gray; font-size: 16px; margin-right: 5px;">Mã sản phẩm:</p>
                                <p style="font-weight: bold;">
                                    <?php echo $items['code_pro'];?>
                                    <input type="hidden" name="code_pro" id="code_pro" value="<?php echo $items['code_pro'];?>">
                                </p>
                            </span>
                            <p style="margin: 20px 0px 20px 0px ;font-weight:bold; font-size:x-large;">
                                <?php echo number_format($items['price'],0,',') . 'VNĐ';?>
                                <input type="hidden" name="price" id="priceDisplay"  value="<?php echo $items['price'];?>">
                            </p>
            <?php
            break;
            endforeach?>
                            <span class="d-flex mt-2">
                                <p style="color: gray; font-size: 16px; margin-right: 5px;">Màu sắc:</p>
                                <?php
                                    $uniqueColor = [];
                                    foreach ($detailPro as $items):
                                        if (in_array($items['name_color'], $uniqueColor)) {
                                            continue;
                                        }
                                ?>
                                <p style="font-weight: bold; font-size:14px; display: flex; padding-top: 2px;"><?php echo $items['name_color']; echo " , ";?></p>
                                <?php 
                                    $uniqueColor[] = $items['name_color'];
                                    endforeach;
                                ?>
                            </span>
                            <?php 
                                echo form_erros('color_name', $erros, '<span class = "erros">','</span>', );
                            ?>
                            <div class="chosse-color">
                                 <?php
                                    $uniqueColor = [];
                                    foreach ($detailPro as $items):
                                        $disabled = ($items['quantity'] <= 0) ? 'disabled' : '';
                                        if (in_array($items['name_color'], $uniqueColor)) {
                                            continue;
                                        }
                                ?>
                                <button type="button" disabled>
                                        <div class="circle-prodetail" style="background-color: <?php echo $items['color_code'];?>;">
                                            <input type="radio" <?php echo $disabled;?> style="margin: 8px 2px 8px 2px" id="color_name" name="color_name" placeholder="<?php echo $items['name_color'];?>" value="<?php echo $items['id_color'];?>">
                                        </div>
                                </button>
                                <?php 
                                    $uniqueColor[] = $items['name_color'];
                                    endforeach;
                                ?>
                            </div>
                       
                        
                            <!--  -->
                            <span class="d-flex mt-2">
                                <p style="color: gray; font-size: 16px; margin-right: 5px;">Kích Thước:</p>
                                <?php foreach ($detailPro as $items):
                                ?>
                                <p style="font-weight: bold;"><?php echo $items['name_size']; echo " ,"?></p>
                                <?php
                                endforeach;
                                ?>
                            </span>
                            <?php 
                                echo form_erros('size_name', $erros, '<span class = "erros">','</span>', );
                            ?>
                            <div class="chosse-color">
                            <?php 
                            foreach ($detailPro as $items):
                            $disabled = ($items['quantity'] <= 0) ? 'disabled' : '';
                            ?>
                                <button disabled type="button" style="color: black;">
                                    <p class="d-flex justify-content-between">
                                        <?php echo $items['name_size'];?>
                                        <input type="radio" <?php echo $disabled;?> id="size_name" name="size_name" placeholder="<?php echo $items['name_size'];?>"  value="<?php echo $items['id_size'];?>">
                                    </p>
                                </button>
                                <?php 
                            endforeach;
                            ?>
                            </div>
                       
                        </div>
                        <div class="row mt-5 mb-5">
                            <div class="col-8">
                                <input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user;?>">
                                <input type="hidden" name="id" value="<?php echo $pro_id ;?>">
                                <input type="hidden" class="id_variant" value="<?php echo $items['id'] ;?>">
                                <button type="button" class="addToCart">
                                    Thêm Vào Giỏ
                                </button>
                            </div>
                            <div class="col-4">
                                <button type="submit">Tìm tại cửa hàng</button>
                            </div>
                        </div>
                        <hr style="width: 100%; margin: 0px 10px 20px 0px;">
                        <div>
                            <p style="font-weight: bold; font-size:18px; margin-bottom: 5px;">Mô Tả</p>
                            <span style="color:gray">
                                <?php foreach ($detailPro as $items) {
                                    echo $items['des_pro'];
                                    break;
                                }?>
                            </span>
                        </div>
                        <hr style="width: 100%; margin: 20px 10px 20px 0px;">
                        <div>
                            <p style="font-weight: bold; font-size:18px; margin-bottom: 5px;">Chất Liệu</p>
                            <span style="color:gray">
                                100% Cotton
                            </span>
                        </div>
                        <hr style="width: 100%; margin: 20px 10px 20px 0px;">
                        <div>
                            <p style="font-weight: bold; font-size:18px; margin-bottom: 5px;">Hướng Dẫn Sử Dụng</p>
                            <span style="color:gray">
                            <?php foreach ($detailPro as $items) {
                                    echo $items['des_pro'];
                                    break;
                                }?>
                            </span>
                        </div>
                        <hr style="width: 100%; margin: 20px 10px 20px 0px;">
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <!--  -->
    <div style="margin-top: 10%; margin-bottom: 20px;">
        <div class="container-pro">
            <div class="row d-flex  mt-5 ">
                <div class="col-sm d-flex justify-content-center ps-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"  class="bi bi-truck color-icons" viewBox="0 0 16 16">
                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                </svg>
                <div class="ps-3">
                    <p class="fw-bold" style="margin-bottom: 0px;">Miễn Phí Giao Hàng </p>
                    <p class="paragraph">Đơn hàng có giá trị từ 500.000 VNĐ</p>
                </div>
                </div>
                <div class="col-sm d-flex justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-wallet2 pt-2 color-icons" viewBox="0 0 16 16">
                <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                </svg>
                <div class="ps-3">
                    <p class="fw-bold" style="margin-bottom: 0px;">Thanh Toán Khi Nhận Hàng(COD) </p>
                    <p class="paragraph">Giao hàng trên toàn quốc</p>
                </div>
                </div>
                <div class="col-sm d-flex justify-content-center ps-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-archive pt-1 color-icons" viewBox="0 0 16 16">
                <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                </svg>
                <div class="ps-3">
                    <p class="fw-bold" style="margin-bottom: 0px;">Đổi Hàng Miễn Phí </p>
                    <p class="paragraph">Trong 30 ngày kể từ ngày mua</p>
                </div>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="container-main">
            <div class="sale-pro">
            <h2 class="fw-bolder mt-5 mb-4">Gợi Ý Mua Cùng</h2>
            <div class="row">
            <?php 
                foreach ($listProducts as $items) :
            ?>
            <div class="pro col">
                <div class=" pro px-2">
                <a href="<?php echo _WEB_HOST;?>?module=home&action=detailProduct&id=<?php echo $items['product_id'];?>">
                    <div class="img-pro">
                        <img src="uploads/<?php echo $items['image'];?>" alt="" srcset="">
                        <button class="btn-add" type="submit">Xem Sản Phẩm</button>
                </div>
                </a>
                <div class="infor-pro">
                    <p><a href="<?php echo _WEB_HOST;?>?module=home&action=detailProduct&id=<?php echo $items['product_id'];?>" style="text-decoration: none; color: gray;"><?php echo $items['product_name']?></a></p>
                    <p><?php echo $items['price'];?> VNĐ</p>
                    <p>199.000 VNĐ</p>
                </div>
                </div>
            </div>
            <?php endforeach;?>
            </div>
            </div>
        </div>
    </div>
</main>
<!--  -->
<script>
    $(document).ready(function () {
    $('input[name="color_name"], input[name="size_name"]').change(function () {
        // Lấy giá trị của các radio
        let selectedColor = $('input[name="color_name"]:checked').val();
        let selectedSize = $('input[name="size_name"]:checked').val();
        // Lấy thông tin sản phẩm
        let name_product = $('#product_name').val();
        let img = $('#image').val();
        let code_pro = $('#code_pro').val();
        let price = $('#priceDisplay').val();
        let id_user = $('#id_user').val();
        let id_product_variant = $(".id_variant").val()
        // Kiểm tra xem cả hai radio đã được chọn chưa
        if (selectedColor && selectedSize) {
          $(".addToCart").click(function (e) { 
            e.preventDefault();
               
                    $.ajax({
                    type: "POST",
                    url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=detailProduct&action=add",
                    data: {
                        id_color:selectedColor,
                        id_size:selectedSize,
                        name_product:name_product,
                        img:img,
                        code_pro:code_pro,
                        price:price,
                        id_user:id_user,
                        id_product_variant: id_product_variant,
                    },
                    success: function (response) {
                        window.location.href = response;
                    }
                });
          });
        }
    });
});
</script>
<?php
layouts('footers/footer-view-user');
?>
 
