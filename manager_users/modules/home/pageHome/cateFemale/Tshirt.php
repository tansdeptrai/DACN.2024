<?php 
$listProduct = getRaw("SELECT id, name, image, cate_id FROM products WHERE cate_id = 5");
$quanList = getRows("SELECT id, name, image, cate_id FROM products WHERE cate_id = 5");
//id người đăng nhập
$id_user = '';
$tokenLogin = getSession('logintoken');
$user_id = oneRaw("SELECT user_ID FROM logintoken WHERE token = '$tokenLogin'");
if ($user_id) {
    $id_user = $user_id['user_ID'];
};
// list sizes
$sizes = getRaw("SELECT id , name_size FROM sizes");
// list Color
$colors = getRaw("SELECT id,name_color, color_code FROM colors");


?>

<div class="row">
    <div class="col-md-auto">
        <!-- size -->
        <button class="btn-filter d-flex justify-content-between" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Kích Cỡ
            <svg class="mt-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                <path fill-rule="evenodd"
                    d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
            </svg>
        </button>

        <div class="collapse" id="collapseExample">
            <div class="card card-body" style="width: 300px; height: auto; margin-top: 5px;">
                <div>
                    <!-- size -->
                    <?php foreach ($sizes as $size) :?>
                    <button class="btn-filter-size" data-id="<?php echo $size['id'];?>" type="button"><?php echo $size['name_size'];?></button>
                    <?php endforeach;?>
                    <!--  -->
                </div>
            </div>
        </div>
        <!-- end size -->

        <!-- Color -->
        <button class="btn-filter d-flex justify-content-between mt-3" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
            Màu Sắc
            <svg class="mt-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                <path fill-rule="evenodd"
                    d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
            </svg>
        </button>
        <!--  -->
        <div class="collapse" id="collapseExample1">
            <div class="card card-body" style="width: 300px; height: auto; margin-top: 5px;">
                <div>
                    <!--  -->
                    <?php foreach ($colors as $color):;?>
                        <button class="btn-filter-color" data-id="<?php echo $color['id'];?>" type="button">
                            <div class="color" style="background-color: <?php echo $color['color_code'];?>;"></div>
                        </button>
                    <?php endforeach?>
                    <!--  -->
                </div>
            </div>
        </div>
        <!--  -->
        <!-- end color -->

        <!-- Price -->
        <button class="btn-filter d-flex justify-content-between mt-3" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
            Khoảng Giá
            <svg class="mt-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                <path fill-rule="evenodd"
                    d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
            </svg>
        </button>

        <div class="collapse" id="collapseExample2">
            <div class="card card-body" style="width: 300px; height: auto; margin-top: 5px;">
                <div>
                    <div class="d-flex ">
                        <input class="price-filter" type="checkbox" name="" id="idCate" value="0">
                        <p class="mt-3 ms-2">100.000 - 300.000 VNĐ</p>
                    </div>
                    <div class="d-flex ">
                        <input class="price-filter" type="checkbox" name="" id="idCate" value="1">
                        <p class="mt-3 ms-2">300.000 - 500.000 VNĐ</p>
                    </div>
                    <div class="d-flex ">
                        <input class="price-filter" type="checkbox" name="" id="idCate" value="2">
                        <p class="mt-3 ms-2">500.000 - 1.000.000 VNĐ</p>
                    </div>
                    <div class="d-flex ">
                        <input class="price-filter" type="checkbox" name="" id="idCate" value="3">
                        <p class="mt-3 ms-2">1.000.000 - 1.300.000 VNĐ</p>
                    </div>
                    <div class="d-flex ">
                        <input class="price-filter" type="checkbox" name="" id="idCate" value="4">
                        <p class="mt-3 ms-2">1.300.000 - 1.500.000 VNĐ</p>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($listProduct as $product):?>
                    <input type="hidden"  class="idCateProduct"  data-id="<?php echo $product['cate_id'];?>">
                 <?php 
                    break;
                    endforeach;
                ?>  
        <!-- End Price -->
    </div>
    <div class="col">
        <div class="contentProductTshirt">
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
                    <span
                        style="font-weight: 600; font-size:15px; color:black; padding-top:10px; letter-spacing: 1px;">Số
                        Lượng :
                        <?php echo $quanList;?></span> <!-- số lượng tổng -->
                </div>
            </div>
            <!-- Product -->
            <div class="product-container2 mt-3 mb-2">
                <!--  -->
                <?php foreach ($listProduct as $product):;?>
                <div class="product-item2">
                    <a href="">
                        <img class="image<?php echo $product['id'];?>" src="uploads/<?php echo $product['image'];?>">
                    </a>
                    <button class="addToCart showPopup" data-id="<?php echo $product['id'];?>" value="<?php echo $product['id'];?>">Thêm vào giỏ hàng</button>
                    <div class="inforProduct2">
                        <div class="colorProduct d-flex mt-2 mb-1">
                            <?php 
                                    $id_product = $product['id'];
                                    $variantProducts = getRaw("SELECT id, product_id, color_id,size_id FROM variant_products WHERE product_id = $id_product");
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
                            <button class="btnColor" data-idvp="<?php echo $vp['id']; // id variant Product?>" data-id="<?php echo $color['id'];?>" data-idsize="<?php echo $vp['size_id'];?>" data-idpro="<?php echo $product['id'];?>" style="background-color: <?php echo $color['color_code']; ?>;">
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
                             
                <!--  -->
            </div>
            <!-- Pobhub add to cart -->
            <div id="overlay"></div>
            <div class="popup" id="popup">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <p class="npr_popup" id="namePro"></p>    
                        <p class="npr_popup" id="color"></p> 
                        <p id="mess2" style="color: red; text-align: left; font-size:14px; margin-top:3px; margin-bottom:0px; margin-left:20px;"></p>
                    </div>
                          <!-- name Product -->
                    <svg id="closePopup" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
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
                                <p id="price" style=" margin-left: 10px; color:black; font-weight:bold; margin-bottom: 5px;"></p>
                            </div>
                            <div class="d-flex">
                                <span>SL còn:</span>
                                <p id="quantity" style=" margin-left: 10px; color:black; font-weight:bold; margin-bottom: 5px;"></p>
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
                        <div>
                            <img style="border-radius: 2px; border:2px solid lightgray; " width="100%" height="auto" src="https://media.canifa.com/Simiconnector/BannerSlider/b/l/blacknov_topbanner_desktop-14.11.webp" alt="">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="idUser" value="<?php echo $id_user;?>">
                <button type="button" class="btn-add-to-cart">Thêm vào giỏ hàng</button>
            </div>
            <!-- end pobhub -->
        </div>
    </div>

    

</div>
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
var idSize='';
var idCateProduct = $(".idCateProduct").data('id');
// var listVariant = [];

$(".btnColor").click(function (e) { 
    e.preventDefault();
    idColor = $(this).data('id');
    id_product_variant = $(this).data('idvp');
    // console.log( 'id_variant_product' + id_product_variant);
    // console.log('màu nè: ' + idColor );
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