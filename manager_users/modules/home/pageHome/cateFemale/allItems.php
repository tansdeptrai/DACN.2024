<?php
//id người đăng nhập
$id_user = '';
$tokenLogin = getSession('logintoken');
$user_id = oneRaw("SELECT user_ID FROM logintoken WHERE token = '$tokenLogin'");
if ($user_id) {
    $id_user = $user_id['user_ID'];
};
// list áo phông
$listProductsTshirt = getRaw("SELECT id, name, image, cate_product_id FROM products WHERE cate_product_id = 12 AND cate_id =5 ORDER BY RAND() LIMIT 3");
// list áo polo
$listProductPolo = getRaw("SELECT id, name, image, cate_product_id FROM products WHERE cate_product_id = 12 AND cate_id = 4 ORDER BY RAND() LIMIT 3");
$listProductSuggest = getRaw("SELECT id, name, image, cate_product_id FROM products WHERE cate_product_id = 12  ORDER BY RAND() LIMIT 8");
?>
<!-- Banner -->
<div>
    <img width="100%" height="100%"
        src="https://media.canifa.com/Simiconnector/women_cate_desktop-15Nov.webp" alt="">
</div>
<!-- End Bannner -->
<!-- áo phông -->
<!-- Title -->
<div class="mt-4 d-flex justify-content-between">
    <div class="d-flex">
        <span style="font-weight: 600; font-size:25px; letter-spacing: 1px;">Áo Phông</span>
        <p id="mess"
            style="color: red; text-align: left; font-size:18px; margin-top:5px; margin-left:20px; margin-bottom:0px;">
        </p>
    </div>
    <a href="#?module=home/pageHome/cateFemale&action=Tshirt"
        style="font-weight: 600; text-decoration: none; font-size:15px; color:	#FF0000; padding-top:15px;" class="more">
        Xem thêm </a>
</div>
<!-- End Title -->
<!-- Product -->
<!-- ÁO PHÔNG -->
<div class="row">

    <div class="col-4">
        <img class="pt-3" style="width: 100%;" height="auto"
            src="https://media.canifa.com//catalog/category/nu-5.canifa-z.jpg" alt="">
    </div>
    <div class="col-8">
        <div class="product-container mt-3 mb-2">
            <!--  -->
            <?php foreach($listProductsTshirt as $p):?>
            <div class="product-item">
                <a href="">
                    <img class="image<?php echo $p['id'];?>" src="uploads/<?php echo $p['image'];?>">
                </a>
                <input type="hidden" class="idProduct" value="<?php echo $p['id'];?>"> <!-- id product -->
                <button class="showPopup" data-id="<?php echo $p['id'];?>">Thêm vào giỏ hàng</button>
                <div class="inforProduct">
                    <div class="colorProduct d-flex mt-2 mb-1">
                        <?php
                            $idProduct = $p['id'];
                            $variantPro = getRaw("SELECT id, product_id, color_id, price, size_id FROM variant_products WHERE product_id = $idProduct");
                            $seen = [];
                            foreach ($variantPro as $vp):
                                if ($idProduct == $vp['product_id']) :
                                    $uniqueKey = $vp['product_id'] . '-' . $vp['color_id'];
                                    if (in_array($uniqueKey, $seen)) {
                                        continue;
                                    }
                                    $seen[] = $uniqueKey;
                                    $idColor = $vp['color_id'];
                                    if ($idColor):
                                        $color = getRaw("SELECT color_code FROM colors WHERE id = $idColor");
                                        foreach($color as $c):
                        ?>
                        <button class="btnColor" style="background-color: <?php echo $c['color_code']?>;"
                            data-idcolor="<?php echo $vp['color_id'];?>" data-idvp="<?php echo $vp['id'];?>" data-idsize="<?php echo $vp['size_id'];?>" data-idpro ="<?php echo $p['id'];?>"></button>
                        <?php
                                        endforeach;
                                    endif;
                                endif;
                            endforeach;
                        ?>
                    </div>
                    <a class="" href="">
                        <p style="font-weight: 500; color:gray;"><?php echo $p['name']?></p>
                    </a>
                    <?php foreach ($variantPro as $vp):;?>
                    <p style="font-weight: bold;"><?php echo number_format($vp['price'], 0, ',', '.') . ' VNĐ';?></p>
                    <?php 
                        break;
                        endforeach;
                    ?>
                </div>
            </div>
            <?php endforeach;?>
            <!--  -->
        </div>
    </div>

</div>
<!-- end  ÁO PHÔNG -->

<!-- qUẦN SOOC -->
<!-- Title -->
<div class="mt-4 d-flex justify-content-between">
    <span style="font-weight: 600; font-size:25px; letter-spacing: 1px;">Quần Soóc</span>
    <!-- tên danh mục select -->
    <a href="#?module=home/pageHome/cateFemale&action=feltPants"
        style="font-weight: 600; text-decoration: none; font-size:15px; color:	#FF0000; padding-top:15px;" class="more">
        Xem thêm </a>
</div>
<!-- End Title -->
<div class="row">
    <div class="col-4">
        <img class="pt-3" style="width: 100%;" height="auto"
            src="https://media.canifa.com/Blog/6bs24s007-sj852-1-ag.webp" alt="">
    </div>
    <div class="col-8">
        <div class="product-container mt-3 mb-2">
            <!--  -->
            <div class="product-item">
                <a href="">
                    <img src="https://canifa.com/img/500/750/resize/5/t/5tw24w001-sm176-m-1-u.webp">
                </a>
                <button>Thêm vào giỏ hàng</button>
                <div class="inforProduct">
                    <div class="colorProduct d-flex mt-2 mb-1">
                        <button style="background-color: red; "></button>
                        <button style="background-color: aqua; "></button>
                        <button style="background-color: pink; "></button>
                        <button style="background-color: yellowgreen; "></button>
                    </div>
                    <a class="" href="">
                        <p>Áo nỉ có mũ unisex người lớn</p>
                    </a>
                    <p>120.000 VNĐ</p>
                </div>
            </div>

            <div class="product-item">
                <a href="">
                    <img src="https://canifa.com/img/500/750/resize/5/t/5tw24w001-sm176-m-1-u.webp">
                </a>
                <button>Thêm vào giỏ hàng</button>
                <div class="inforProduct">
                    <div class="colorProduct d-flex mt-2 mb-1">
                        <button style="background-color: red; "></button>
                        <button style="background-color: aqua; "></button>
                        <button style="background-color: pink; "></button>
                        <button style="background-color: yellowgreen; "></button>
                    </div>
                    <a class="" href="">
                        <p>Áo nỉ có mũ unisex người lớn</p>
                    </a>
                    <p>120.000 VNĐ</p>
                </div>
            </div>

            <div class="product-item">
                <a href="">
                    <img src="https://canifa.com/img/500/750/resize/5/t/5tw24w001-sm176-m-1-u.webp">
                </a>
                <button>Thêm vào giỏ hàng</button>
                <div class="inforProduct">
                    <div class="colorProduct d-flex mt-2 mb-1">
                        <button style="background-color: red; "></button>
                        <button style="background-color: aqua; "></button>
                        <button style="background-color: pink; "></button>
                        <button style="background-color: yellowgreen; "></button>
                    </div>
                    <a class="" href="">
                        <p>Áo nỉ có mũ unisex người lớn</p>
                    </a>
                    <p>120.000 VNĐ</p>
                </div>
            </div>
            <input type="hidden" name="" id="idCate" value="cate áo ohoong nè đò ngu">
            <!--  -->
        </div>
    </div>
</div>
<!-- end QUẦN SOOC  -->

<!-- polo  -->
<!-- Title -->
<div class="mt-4 d-flex justify-content-between">
    <span style="font-weight: 600; font-size:25px; letter-spacing: 1px;">Áo polo</span>
    <!-- tên danh mục select -->
    <a href="#?module=home/pageHome/cateFemale&action=polo"
        style="font-weight: 600; text-decoration: none; font-size:15px; color:	#FF0000; padding-top:15px;" class="more">
        Xem thêm </a>
</div>
<!-- End Title -->
<div class="row">
    <div class="col-4">
        <img class="pt-3" style="width: 100%;" height="auto"
            src="https://canifa.com/img/500/750/resize/6/t/6tp24s005-sw001-thumb.webp" alt="">
    </div>
    <div class="col-8">
        <div class="product-container mt-3 mb-2">
            <!--  -->
            <?php foreach($listProductPolo as $p):?>
            <div class="product-item">
                <a href="">
                    <img class="image<?php echo $p['id'];?>" src="uploads/<?php echo $p['image'];?>">
                </a>
                <input type="hidden" class="idProduct" value="<?php echo $p['id'];?>"> <!-- id product -->
                <button class="showPopup" data-id="<?php echo $p['id'];?>">Thêm vào giỏ hàng</button>
                <div class="inforProduct">
                    <div class="colorProduct d-flex mt-2 mb-1">
                        <?php
                            $idProduct = $p['id'];
                            $variantPro = getRaw("SELECT id, product_id, color_id, price, size_id FROM variant_products WHERE product_id = $idProduct");
                            $seen = [];
                            foreach ($variantPro as $vp):
                                if ($idProduct == $vp['product_id']) :
                                    $uniqueKey = $vp['product_id'] . '-' . $vp['color_id'];
                                    if (in_array($uniqueKey, $seen)) {
                                        continue;
                                    }
                                    $seen[] = $uniqueKey;
                                    $idColor = $vp['color_id'];
                                    if ($idColor):
                                        $color = getRaw("SELECT color_code FROM colors WHERE id = $idColor");
                                        foreach($color as $c):
                        ?>
                        <button class="btnColor" style="background-color: <?php echo $c['color_code']?>;"
                            data-idcolor="<?php echo $vp['color_id'];?>" data-idvp="<?php echo $vp['id'];?>" data-idsize="<?php echo $vp['size_id'];?>" data-idpro="<?php echo $p['id'];?>"></button>
                        <?php
                                        endforeach;
                                    endif;
                                endif;
                            endforeach;
                        ?>
                    </div>
                    <a class="" href="">
                        <p style="font-weight: 500; color:gray;"><?php echo $p['name']?></p>
                    </a>
                    <?php foreach ($variantPro as $vp):;?>
                    <p style="font-weight: bold;"><?php echo number_format($vp['price'], 0, ',', '.') . ' VNĐ';?></p>
                    <?php 
                        break;
                        endforeach;
                    ?>
                </div>
            </div>
            <?php endforeach;?>
            <!--  -->
        </div>
    </div>
</div>
<!-- end polo  -->

<!-- row 4 -->
<!-- Title -->
<div class="mt-4 d-flex justify-content-between">
    <span style="font-weight: 600; font-size:25px; letter-spacing: 1px;">Váy</span>
    <!-- tên danh mục select -->
    <a href="#?module=home/pageHome/cateFemale&action=pantsMale"
        style="font-weight: 600; text-decoration: none; font-size:15px; color:	#FF0000; padding-top:15px;" class="more">
        Xem thêm </a>
</div>
<!-- End Title -->
<div class="row">
    <div class="col-4">
        <img class="pt-3" style="width: 100%;" height="auto"
            src="https://canifa.com/img/500/750/resize/6/d/6ds24s022-se441-thumb.webp" alt="">
    </div>
    <div class="col-8">
        <div class="product-container mt-3 mb-2">
            <!--  -->
            <div class="product-item">
                <a href="">
                    <img src="https://canifa.com/img/500/750/resize/5/t/5tw24w001-sm176-m-1-u.webp">
                </a>
                <button>Thêm vào giỏ hàng</button>
                <div class="inforProduct">
                    <div class="colorProduct d-flex mt-2 mb-1">
                        <button style="background-color: red; "></button>
                        <button style="background-color: aqua; "></button>
                        <button style="background-color: pink; "></button>
                        <button style="background-color: yellowgreen; "></button>
                    </div>
                    <a class="" href="">
                        <p>Áo nỉ có mũ unisex người lớn</p>
                    </a>
                    <p>120.000 VNĐ</p>
                </div>
            </div>
            <input type="hidden" name="" id="idCate" value="cate áo ohoong nè đò ngu">
            <!--  -->
        </div>
    </div>
</div>
<!-- end row 4 -->

<!-- Gợi ý cho bạn -->
<div class="mt-4 d-flex justify-content-between">
    <span style="font-weight: 600; font-size:25px; letter-spacing: 1px;">Gợi Ý Cho Bạn</span>
</div>
<div class="product-container1 mt-3 mb-2">
    <!--  -->
    <?php foreach ($listProductSuggest as $product):;?>
        <div class="product-item2">
            <a href="">
                <img class="image<?php echo $product['id'];?>" src="uploads/<?php echo $product['image'];?>">
            </a>
            <button class="addToCart showPopup" data-id="<?php echo $product['id'];?>"
                value="<?php echo $product['id'];?>">Thêm vào giỏ hàng</button>
            <div class="inforProduct2">
                <div class="colorProduct d-flex mt-2 mb-1">
                    <?php 
                                        $id_product = $product['id'];
                                        $variantProducts = getRaw("SELECT id, product_id, color_id, size_id FROM variant_products WHERE product_id = $id_product");
                                        $seen = [];
                                        foreach ($variantProducts as $vp) :
                                            
                                            if ($id_product == $vp['product_id']) :
                                                $uniqueKey = $vp['product_id'] . '-' . $vp['color_id'];
                                                if (in_array($uniqueKey, $seen)) {
                                                    continue; 
                                                }
                                                $seen[] = $uniqueKey;
                                                $id_color = $vp['color_id'];
                                                $listColor = getRaw("SELECT id, color_code FROM colors WHERE id = $id_color");
                                                foreach ($listColor as $color) :
                                    ?>
                                    <button class="btnColor" data-idvp="<?php echo $vp['id']; // id variant Product?>" data-idpro="<?php echo $product['id'];?>" data-idsize="<?php echo $vp['size_id'];?>"
                                        data-idcolor="<?php echo $color['id'];?>" data-idsize="<?php echo $vp['size_id'];?>" style="background-color: <?php echo $color['color_code']; ?>;">
                                    </button>
                    <?php 
                                            endforeach;
                                        endif;
                                        endforeach;
                                    ?>
                </div>
                <input type="hidden" id="idProduct" value="<?php echo $product['id'];?>"> <!-- id Product -->
                <p><?php echo $product['name']?></p>
                <?php
                                $id_product = $product['id'];
                                $listProductVariants = getRaw("SELECT price  FROM variant_products WHERE product_id = $id_product");
                                foreach ($listProductVariants as $vp):?>
                <p><?php echo number_format($vp['price'], 0, ',', '.') . ' VNĐ';?></p>
                <?php
                                break; 
                                endforeach;
                            ?>
            </div>
        </div>
    <?php endforeach;?>

    <input type="hidden" name="" id="idCate" value="cate áo ohoong nè đò ngu">
    <!--  -->
</div>
<div class="product-container">
    <!-- Pobhub add to cart -->
    <div id="overlay"></div>
    <div class="popup" id="popup">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <p class="npr_popup" id="namePro"></p>
                <p class="npr_popup" id="color"></p> 
                <p id="mess2"
                    style="color: red; text-align: left; font-size:14px; margin-top:3px; margin-bottom:0px; margin-left:20px;">
                </p>
            </div>
            <!-- name Product -->
            <svg id="closePopup" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-x-lg" viewBox="0 0 16 16">
                <path
                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
            </svg>
        </div>
        <div class="row">
            <div class="col d-flex">
                <div class="imgProPopup">
                    <img id="imagePro" src="" alt="Hình ảnh sản phẩm">
                </div>
                <div style="font-size: 14px;" class="price_quanti ms-3">
                    <div class="d-flex">
                        <span>Giá thành:</span>
                        <p id="price" style=" margin-left: 10px; color:black; font-weight:bold; margin-bottom: 5px;">
                        </p>
                    </div>
                    <div class="d-flex">
                        <span>SL còn:</span>
                        <p id="quantity" style=" margin-left: 10px; color:black; font-weight:bold; margin-bottom: 5px;">
                        </p>
                    </div>
                    <div class="d-flex">
                        <span>Mã sản phẩm:</span>
                        <p id="code_pro" style=" margin-left: 10px; color:black; font-weight:bold; margin-bottom: 5px;">
                        </p>
                    </div>
                    <!-- tăng giảm số lượng -->
                    <div class=" d-flex" style="margin-top: 40px;">
                        <button class="btnDrop" id="reduce">-</button>
                        <input class="quantityPopup" type="text" id="quantity" disabled value="1">
                        <button class="btnPlus" id="increase">+</button>
                    </div>
                </div>

            </div>
            <div class="col ">
                <!-- biến thể của sản phẩm -->
                <div class="d-flex variants"></div>
                <div>
                    <img style="border-radius: 2px; border:2px solid lightgray; " width="100%" height="auto"
                        src="https://media.canifa.com/Simiconnector/BannerSlider/b/l/blacknov_topbanner_desktop-14.11.webp"
                        alt="">
                </div>
            </div>
        </div>
        <input type="hidden" id="idUser" value="<?php echo $id_user;?>">
        <button type="button" class="btn-add-to-cart">Thêm vào giỏ hàng</button>
    </div>
    <!-- end pobhub -->
</div>
<!-- kết thúc gợi ý cho bạn -->
<script>
$(document).ready(function() {
    $(".more").click(function(e) {
        e.preventDefault();
        var hrf = $(this).attr("href");
        var link = hrf.substring(1, hrf.length);
        $("#contentProductMale").load(link);
    });
});
//khai báo
var idColor = '';
var id_size = '';
var quantity_vp = '';
var id_product_variant = '';
var price_vp = '';
var image_vp = '';
var code_pro = '';
var name_product = '';
var idSize='';
let listVariant = [];
$(document).ready(function() {
    $(".btnColor").click(function(e) {
        e.preventDefault();
        idColor = $(this).data('idcolor');
        id_product_variant = $(this).data('idvp');
        let id_product = $(this).data('idpro');
        idSize = $(this).data('idsize');
        $.ajax({
            type: "POST",
            url: "?module=home/pageHome/cateMale/actioncateMale&action=getImage",
            dataType: 'json',
            data: {
                id_product_variant:id_product_variant,
            },
            success: function (response) {
                // console.log(response.image.image);
                // console.log(response.image.id);
                if (id_product_variant == response.image.id ) {
                    $(".image" + id_product).attr('src', 'uploads/' + response.image.image);
                }
                
                
            }
        });
        
    });
    //tăng giảm số lượng

    $("#increase").click(function() {
        if (quantity_vp) {
            let currentValue = parseInt($(".quantityPopup").val());
            if (currentValue >= quantity_vp) {
                $("#mess2").text('Số lượng đạt giới hạn!');
                setTimeout(function() {
                    $("#mess2").text('');
                }, 4000); // 4000ms = 4 giây
            } else {
                $(".quantityPopup").val(currentValue + 1);
            }
        } else {
            $("#mess2").text('Vui lòng chọn size cho sản phẩm!!');
            setTimeout(function() {
                $("#mess2").text('');
            }, 4000); // 4000ms = 4 giây
        }

    });
    $("#reduce").click(function() {
        let currentValue = parseInt($(".quantityPopup").val());
        if (quantity_vp) {
            if (currentValue <= 1) { // Không giảm dưới 1
                $("#mess2").text('Số lượng tối thiểu phải là 1');
                setTimeout(function() {
                    $("#mess2").text('');
                }, 4000); // 4000ms = 4 giây
            } else {
                $(".quantityPopup").val(currentValue - 1);
            }
        } else {
            $("#mess2").text('Vui lòng chọn size cho sản phẩm!!');
            setTimeout(function() {
                $("#mess2").text('');
            }, 4000); // 4000ms = 4 giây
        }
    });

});
//popUp
$(document).ready(function() {
    $(".showPopup").click(function() {
        let idProduct = $(this).data('id'); //id product
        if (idColor) {
            $.ajax({
                type: "POST",
                url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=home/pageHome/cateMale/actioncateMale&action=getInfoProduct",
                data: {
                    id: idProduct,
                    idColor: idColor,
                },
                dataType: 'json',
                success: function(response) {
                    $(".variants").empty(); // làm rỗng khu vực biến thể
                    $("#namePro").text(response.products.name + ' - ');
                    $("#imagePro").attr('src', 'uploads/' + response.products.image);
                    $("#code_pro").text(response.products.code_pro);
                    code_pro = response.products.code_pro;
                    name_product = response.products.name;
                    image_vp = response.products.image;
                    response.nameSizes.forEach(nameSize => {
                        $(".variants").append(' <div style="width: 40px; height:30px; border: 1px solid black; border-radius: 4px; margin-bottom:5px;margin-right:10px; text-align: center; font-weight:bold; color:black; cursor: pointer;   transition: background-color 0.3s ease;" class="myDiv" data-id="' + nameSize.id_size + '" >' + nameSize.name_size +  '</div>');
                        if (idSize == nameSize.id_size) {
                            $('.myDiv[data-id="' + nameSize.id_size + '"]').addClass('clicked');
                            response.changer.forEach(variant=>{
                                if (idSize == variant.idSize) {
                                    $("#price").text(variant.price + ' VNĐ');
                                    $("#quantity").text(variant.quantity);
                                    $("#imagePro").attr('src', 'uploads/' + variant.image);
                                    $('#color').text(variant.idColor);
                                }
                            });
                        }
                    
                    });
                    listVariant.push(response.changer);


                }
            });
            $("#overlay").fadeIn();
            $("#popup").fadeIn();

        } else {
            alert('Vui lòng chọn màu sắc!!!');
            // setTimeout(function() {
            //     $("#mess").text('');
            // }, 5000); // 4000ms = 4 giây
        }
    });
    $('#overlay').click(function() {
        if (idColor) {
            idColor = '';
            $("#price").text('');
            $("#quantity").text('');
        }
        console.log('Popup đã đóng (click vào ngoài popup)'); // Sự kiện khi popup đóng
    });
    //Đóng popup
    $("#closePopup, #overlay").click(function() {
        if (idColor) {
            idColor = '';
            $("#price").text('');
            $("#quantity").text('');
        }
        $("#overlay").fadeOut();
        $("#popup").fadeOut();
    });
    //button variant
    $(".variants").on('click', ".myDiv", function() {
        $(".myDiv").removeClass('clicked');
        $(this).toggleClass('clicked');
        id_size = $(this).data('id');
        console.log(id_size); //id_size
        // console.log(listVariant);
        listVariant.forEach(variant => {
            variant.forEach(vp => {

                if (id_size == vp.idSize) {
                    $("#price").text(vp.price + ' VNĐ');
                    $("#quantity").text(vp.quantity);
                    $("#imagePro").attr('src', 'uploads/' + vp.image);
                    $('#color').text(vp.idColor);
                    quantity_vp = vp.quantity;
                    price_vp = vp.price;
                }
            });
        });
        // add to cart
        $(".btn-add-to-cart").click(function(e) {
            e.preventDefault();
            if (id_size) {
                let quantity = $(".quantityPopup").val();
                let idUser = $("#idUser").val();
                // alert('ID SIZE: ' + id_size + 'Quantity: ' + quantity + 'Color: ' + idColor);
                $.ajax({
                    type: "POST",
                    url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=home/pageHome/cateMale/actioncateMale&action=addToOrder",
                    data: {
                        idUser: idUser,
                        color_name: idColor,
                        quantity: quantity,
                        size_name: id_size,
                        id_product_variant: id_product_variant,
                        price_vp: price_vp,
                        image_vp: image_vp,
                        code_pro: code_pro,
                        name_product: name_product,
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#mess2").text(response.success);
                        };
                        if (response.error) {
                            $("#mess2").text(response.error);
                        };
                        if (response.login) {
                            $("#mess2").text(response.login);
                            setTimeout(function() {
                                window.location.href =
                                    "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=auth&action=login";
                            }, 4000); //4s chuyển trang 
                        }
                    },
                });

            } else {
                $("#mess2").text('Vui lòng chọn Size!!!');
            }
        });
    });
});
</script>