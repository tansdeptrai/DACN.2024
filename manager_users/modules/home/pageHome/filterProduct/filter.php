<?php 
if (isset($_POST['idCate'], $_POST['idCheckBox']) && !empty($_POST['idCate']) && !empty('idCheckBox')) {
    $id_user = '';
    $tokenLogin = getSession('logintoken');
    $user_id = oneRaw("SELECT user_ID FROM logintoken WHERE token = '$tokenLogin'");
    if ($user_id) {
        $id_user = $user_id['user_ID'];
    };
    $idCate = $_POST['idCate'];
    $idCheckBox = $_POST['idCheckBox'];
    $variantProducts = '';
    $products = '';
    $quantity = '';
    $price = '';
    if ($idCheckBox == 0) {
        //Lọc giá từ 100->300
        $variantProducts = getRaw("SELECT   product_id, cate_id, id, color_id, size_id, quantity, price  FROM variant_products  WHERE cate_id = $idCate AND price >= 100000 AND price <= 300000 GROUP BY product_id, cate_id, color_id, price, id");  
            $uniqueProducts = [];
            $seenProductIds = [];
            foreach ($variantProducts as $item) {
                $price = $item['price'];
                $quantity = $item['quantity'];
                if (!in_array($item['product_id'], $seenProductIds)) {
                    $uniqueProducts[] = $item;
                    $seenProductIds[] = $item['product_id'];
                }
            }
        $quanList = sizeof($uniqueProducts);
    }elseif ($idCheckBox == 1) {
        $variantProducts = getRaw("SELECT   product_id, cate_id, id, color_id, price, size_id, quantity  FROM variant_products  WHERE cate_id = $idCate AND price >= 300000 AND price <= 500000 GROUP BY product_id, cate_id, color_id, price, id");  
            $uniqueProducts = [];
            $seenProductIds = [];
            foreach ($variantProducts as $item) {
                if (!in_array($item['product_id'], $seenProductIds)) {
                    $uniqueProducts[] = $item;
                    $seenProductIds[] = $item['product_id'];
                }
            }
        $quanList = sizeof($uniqueProducts);
    }elseif ($idCheckBox == 2) {
        //lọc giá từ 500-1000
        $variantProducts = getRaw("SELECT   product_id, cate_id, id, color_id, price,size_id, quantity  FROM variant_products  WHERE cate_id = $idCate AND price >= 500000 AND price <= 1000000 GROUP BY product_id, cate_id, color_id, price, id");  
            $uniqueProducts = [];
            $seenProductIds = [];
            foreach ($variantProducts as $item) {
                if (!in_array($item['product_id'], $seenProductIds)) {
                    $uniqueProducts[] = $item;
                    $seenProductIds[] = $item['product_id'];
                }
            }
        $quanList = sizeof($uniqueProducts);
    }elseif ($idCheckBox == 3) {
        $variantProducts = getRaw("SELECT   product_id, cate_id, id, color_id, price,size_id, quantity  FROM variant_products  WHERE cate_id = $idCate AND price >= 1000000 AND price <= 13000000 GROUP BY product_id, cate_id, color_id, price, id");  
        $uniqueProducts = [];
        $seenProductIds = [];
        foreach ($variantProducts as $item) {
            if (!in_array($item['product_id'], $seenProductIds)) {
                $uniqueProducts[] = $item;
                $seenProductIds[] = $item['product_id'];
            }
        }
        $quanList = sizeof($uniqueProducts);
        $variantProducts = '';  
    }elseif ($idCheckBox == 4) {
        //lọc giá từ 1300->1500
        $variantProducts = getRaw("SELECT   product_id, cate_id, id, color_id, price, size_id, quantity FROM variant_products  WHERE cate_id = $idCate AND price >= 1300000 AND price <= 15000000 GROUP BY product_id, cate_id, color_id, price, id");  
        $uniqueProducts = [];
        $seenProductIds = [];
        foreach ($variantProducts as $item) {
            if (!in_array($item['product_id'], $seenProductIds)) {
                $uniqueProducts[] = $item;
                $seenProductIds[] = $item['product_id'];
            }
        }
        $quanList = sizeof($uniqueProducts);
    } 
    if (!empty($variantProducts)) {
?>
<div>
    <!-- Banner -->
    <div>
        <img width="100%" height="100%"
            src="https://media.canifa.com/Simiconnector/Nam-Banner_gioi_mua_moi_2880x480_copy.webp" alt="">
    </div>
    <div class="mt-4 d-flex justify-content-between">
        <span style="font-weight: 600; font-size:25px; letter-spacing: 1px;">Áo Phông</span>
        <p id="mess" style="color: red; text-align: left; font-size:12px; margin-top:1px; margin-bottom:0px;"></p>

        <!-- tên danh mục select -->
        <span style="font-weight: 600; font-size:15px; color:black; padding-top:10px; letter-spacing: 1px;">Số
            Lượng : <?php echo $quanList;?></span> 
    </div>
</div>
<!-- Product -->
<div class="product-container2 mt-3 mb-2">
    <!--  -->
    <?php 
    foreach ($uniqueProducts as $vp) :
        $idProduct = $vp['product_id'];
        $products = getRaw("SELECT id, name, image FROM products WHERE cate_id = $idCate AND id = $idProduct");
        foreach ($products as $product):;?>
    <div class="product-item2">
        <a href="">
            <img class="image<?php echo $product['id'];?>" src="uploads/<?php echo $product['image'];?>">
            <input type="text" value="<?php echo $product['id'];?>">
        </a>
        <button class="addToCart showPopup" data-id="<?php echo $product['id'];?>"
            value="<?php echo $product['id'];?>">Thêm vào giỏ hàng</button>
        <div class="inforProduct2">
            <div class="colorProduct d-flex mt-2 mb-1">
            <?php
            foreach ($variantProducts as $vp):
                if ($product['id'] == $vp['product_id']):
                    $idColor =  $vp['color_id'];
                    $colors = oneRaw("SELECT id, color_code FROM colors WHERE id = $idColor");
            ?>  
                <button class="btnColor" style="background-color: <?php echo $colors['color_code'];?>;" data-id="<?php echo $colors['id'];?>" data-idvp="<?php echo $product['id'];?>" data-idpro="<?php echo $product['id'];?>"></button>
                <input type="hidden" id="size_id" value="<?php echo $vp['size_id'];?>">
            <?php
                endif;
                endforeach;
            ?>
            </div>
            <input type="hidden" id="idProduct" value="<?php echo $product['id'];?>"> <!-- id Product -->
            
            <p><?php echo $product['name']?></p>
            <p><?php echo number_format($vp['price'], 0, ',', '.') . ' VNĐ';?></p>  
        </div>
    </div>
    <?php endforeach;?>
    <input type="hidden" class="idCateProduct" value="<?php echo $vp['cate_id'];?>"
        data-id="<?php echo $vp['cate_id'];?>">
    <?php endforeach;?>
    <!--  -->
</div>
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
                    <p id="price" class="price" style=" margin-left: 10px; color:black; font-weight:bold; margin-bottom: 5px;" data-id="<?php echo $price;?>"><?php echo number_format($price, 0, ',', '.') . ' VNĐ';?><p>
                </div>
                <div class="d-flex">
                    <span>SL còn:</span>
                    <p id="quantity" class="quantity" style=" margin-left: 10px; color:black; font-weight:bold; margin-bottom: 5px;" data-id="<?php echo $quantity;?>"><?php echo $quantity;?></p>
                </div>
                <div class="d-flex">
                    <span>Mã sản phẩm:</span>
                    <p id="code_pro" style=" margin-left: 10px; color:black; font-weight:bold; margin-bottom: 5px;"></p>
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
            <!--  -->
            <div>
                <img style="border-radius: 2px; border:2px solid lightgray; " width="100%" height="auto"
                    src="https://media.canifa.com/Simiconnector/BannerSlider/b/l/blacknov_topbanner_desktop-14.11.webp"
                    alt="">
            </div>
        </div>
    </div>
    <input type="text" id="idUser" value="<?php echo $id_user;?>">
    <button type="button" class="btn-add-to-cart">Thêm vào giỏ hàng</button>
</div>
<!-- end pobhub -->
<?php
    }else {
?>
    <div>Không có sản phẩm nào trong tầm giá!!!!</div>
<?php
    }
}else {
?>
    <div>Hệ thống lỗi vui lòng thử lại sau!!!!!</div>
<?php
}
?>
<script>
// Lấy id của màu sắc
var idColor = '';
var id_size = '';
var quantity_vp = '';
var id_product_variant = '';
var price_vp = '';
var image_vp = '';
var code_pro = '';
var name_product = '';
var idCateProduct = $(".idCateProduct").data('id');
// var listVariant = [];

$(".btnColor").click(function (e) { 
    e.preventDefault();
    idColor = $(this).data('id');
    id_product_variant = $(this).data('idvp');
    console.log(id_product_variant);
    let id_product = $(this).data('idpro');
    // alert(id_product + "idColor: " +  idColor);
    
    // let id_product = $(this).data('idpro');    
    //     $.ajax({
    //         type: "POST",
    //         url: "?module=home/pageHome/cateMale/actioncateMale&action=getImage",
    //         dataType: 'json',
    //         data: {
    //             id_product_variant:id_product_variant,
    //         },
    //         success: function (response) {
    //             // console.log(response.image.image);
    //             // console.log(response.image.id);
    //             if (id_product_variant == response.image.id ) {
    //                 $(".image" + id_product).attr('src', 'uploads/' + response.image.image);
    //             }
                
                
    //         }
    //     });
    
});

$(".variants").on('click',".myDiv", function() {
        $(".myDiv").removeClass('clicked');
        $(this).toggleClass('clicked');
        id_size = $(this).data('id');
        // console.log(id_size); //id_size
        // console.log(listVariant);
        listVariant.forEach(variant => {
            variant.forEach(vp =>{
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
        
        
    });
//Tăng giảm số lượng
$("#increase").click(function () {
        if (quantity_vp) {
            let currentValue = parseInt($(".quantityPopup").val());  
            if (currentValue >= quantity_vp) {
                $("#mess2").text('Số lượng đạt giới hạn!');
            setTimeout(function() {
                $("#mess2").text('');
            }, 4000); // 4000ms = 4 giây
            }else{
                $(".quantityPopup").val(currentValue + 1);
            }
        }else{
            $("#mess2").text('Vui lòng chọn size cho sản phẩm!!');
            setTimeout(function() {
                $("#mess2").text('');
            }, 4000); // 4000ms = 4 giây
        }
        
        
        
    });
    $("#reduce").click(function () {
        let currentValue = parseInt($(".quantityPopup").val()); 
        if (quantity_vp) {
            if (currentValue <= 1) { // Không giảm dưới 1
                $("#mess2").text('Số lượng tối thiểu phải là 1');
                setTimeout(function() {
                    $("#mess2").text('');
                }, 4000); // 4000ms = 4 giây
            }else{
                $(".quantityPopup").val(currentValue - 1);
            }
        }else{
            $("#mess2").text('Vui lòng chọn size cho sản phẩm!!');
            setTimeout(function() {
                $("#mess2").text('');
            }, 4000); // 4000ms = 4 giây
        }
    });
// pobhub addtoCart
$(document).ready(function() {
    $(".showPopup").click(function() {
        let idProduct = $(this).data('id');             //id product
        let size_id = $("#size_id").val();
         quantity_vp = $(".quantity").data('id');
         price_vp = $(".price").data('id');
        
       if (idColor) {
            $.ajax({
            type: "POST",
            url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=home/pageHome/cateMale/actionCateMale&action=getInfoProduct",
            data: {
                id:idProduct,
                idColor :idColor,
            },
            dataType: 'json',
            success: function (response) {
                $(".variants").empty();   // làm rỗng khu vực biến thể
                $("#namePro").text(response.products.name + ' - ');
                $("#imagePro").attr('src', 'uploads/' + response.products.image);
                $("#code_pro").text(response.products.code_pro);
                code_pro = response.products.code_pro;
                name_product =response.products.name;
                image_vp =response.products.image;
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
            
       }else{
            $("#mess").text('Vui lòng chọn màu sắc!!!');
            setTimeout(function() {
                $("#mess").text('');
            }, 5000); // 4000ms = 4 giây
       }
    });
    // click ra ngoài popup
    $('#overlay').click(function() {
        if (idColor) {
            idColor = '';
            $("#price").text('');
            $("#quantity").text('');
        }
        console.log('Popup đã đóng (click vào ngoài popup)'); // Sự kiện khi popup đóng
    });
    // css focus variant product
    
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
    // add to cart
    $(".btn-add-to-cart").click(function (e) { 
        e.preventDefault();
        if (id_size) {
            let quantity = $(".quantityPopup").val();
            let idUser = $("#idUser").val(); 
            // alert('ID SIZE: ' + id_size + 'Quantity: ' + quantity + 'Color: ' + idColor);
            $.ajax({
                type: "POST",
                url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=home/pageHome/cateMale/actionCateMale&action=addToOrder",
                data: {
                    idUser:idUser,
                    color_name:idColor,
                    quantity:quantity,
                    size_name:id_size,
                    id_product_variant:id_product_variant,
                    price_vp:price_vp,
                    image_vp:image_vp,
                    code_pro:code_pro,
                    name_product:name_product,
                },
                success: function (response) {
                    if (response.success) {
                        $("#mess2").text(response.success);
                    };
                    if(response.error){
                        $("#mess2").text(response.error);
                    };
                    if(response.login){
                        $("#mess2").text(response.login);
                        setTimeout(function(){
                            window.location.href = "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=auth&action=login";
                        }, 4000); //4s chuyển trang 
                    }
                },
            });

        }else{
            $("#mess2").text('Vui lòng chọn Size!!!');
        }
    });
});
</script>
<!-- filter color & size & price -->
<script>
    var idCateProduct = $(".idCateProduct").data('id');
    $(document).ready(function () {
        // btn-filter-size
            $(".btn-filter-size").click(function (e) { 
                e.preventDefault();
                let idSizeFilter = $(this).data('id');
                // console.log('idCate: ' + idCateProduct);
                // console.log( 'idSize: ' +idSizeFilter);
                $.ajax({
                    type: "POST",
                    url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=home/pageHome/filterProduct&action=filterSize",
                    data: {
                        idSize:idSizeFilter,
                        idCate:idCateProduct,
                    },
                    success: function (response) {
                        $('.contentProductTshirt').html(response);
                    }
                });
            });
        // end


        // btn-filter-color
        $(".btn-filter-color").click(function (e) { 
            e.preventDefault();
            let idColorFilter = $(this).data('id');
            console.log( 'idColor: ' + idColorFilter);
            console.log('idCate: ' + idCateProduct);
            $.ajax({
                type: "POST",
                url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=home/pageHome/filterProduct&action=filterColors",
                data: {
                    idColor:idColorFilter,
                    idCate:idCateProduct,
                },
                
                success: function (response) {
                    $('.contentProductTshirt').html(response);
                }
            });
        });
        // filter-price
        $('.price-filter').on('change', function() {
            if ($(this).is(':checked')) {
                $('.price-filter').not(this).prop('checked', false);
            }
        });
        $('.price-filter').on('change', function() {
            if ($(this).is(':checked')) {
                var idCheckBox = $(this).val();
                var link = '?module=home/pageHome/filterPriceProduct&action=filter'
                $.ajax({
                    type: "POST",
                    url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=home/pageHome/filterProduct&action=filter",
                    data: {
                        idCate: idCateProduct,
                        idCheckBox: idCheckBox,
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        $('.contentProductTshirt').html(response);

                    }
                });
            }
        });
    });
</script>

