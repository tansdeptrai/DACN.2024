<?php  
//
if (!isLogin()) {
   redirect("?module=auth&action=login");
}
//
// unset($_SESSION['carts']);
$listProducts = getRaw("SELECT  vp.product_id, MIN(vp.id) AS id ,MIN(vp.image) AS image,MIN(vp.price) AS price, MAX(p.name) AS product_name
FROM variant_products vp
INNER JOIN products p ON vp.product_id = p.id GROUP BY vp.product_id ORDER BY RAND() LIMIT 4");
// 
$token = getSession('logintoken');
$id_user = oneRaw("SELECT user_ID FROM logintoken WHERE token = '$token'");
$user_id = $id_user['user_ID'];
$listOder = getRaw("SELECT id, id_product_variant, image, product_name, price, color_name, size_name, quantity FROM orders WHERE id_user = $user_id");
// 


$data = [
   'pageTitle' => 'CART',
];
layouts('headers/header-view-user', $data);
$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
?>
<div style="background-color: lightgray; height: auto;">
   <div class="container-main" style="margin-top: 80px; padding-top: 80px; padding-bottom: 80px;">
         <div class="row">
               <?php
                  if(!empty($smg)){
                     getSmg($smg, $smg_type);
                  }
               ?>
            <div class="col-8">
               <div class="box-left-cart">
                  <span style="padding-left: 20px; color: red; font-style: italic; font-size:14px;">Lưu ý: Lựa chọn và Tránh thay đổi số lượng của nhiều sản phẩm quá nhiều cùng một lúc !!</span>
                  <table class="table">
                     <thead>
                        <tr>
                           <th scope="col"><input type="checkbox" id="select-all"></th>
                           <th scope="col">Chọn Tất Cả</th>
                           <th scope="col">Giá thành</th>
                           <th scope="col" style="text-align: center;">Số lượng</th>
                           <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           foreach ($listOder as $items):
                        ?>
                        <tr>
                           <th scope="row"><input type="checkbox" name="checkbox" value="<?php echo $items['id'];?>" class="select-item"  style="margin-top: 40px;"></th>
                           <td>
                           <div class="row">
                                 <div class="col-4" style=" width: 100px;">
                                    <div class = "detailImgPro">
                                       <img src="uploads/<?php echo $items['image'];?>" alt="" srcset="">
                                    </div>
                                 </div>
                                 <div class="col-8">
                                    <div class="cartTextPro">
                                       <span>
                                             <?php echo $items['product_name'];?>
                                             <input type="hidden" id="id_product_variant" value="<?php echo $items['id_product_variant'];?>">
                                       </span>
                                       <span class="d-flex">
                                          <p>
                                             <?php 
                                                $id_size = $items['size_name'];
                                                $sizes = oneRaw("SELECT name_size FROM sizes WHERE id = $id_size");
                                                foreach ($sizes as $size) {
                                                   echo $size;
                                                };
                                             ?>
                                          </p>
                                          <div class="vertical-line"></div>
                                          <p><?php 
                                              $id_color = $items['color_name'];
                                              $colors = oneRaw("SELECT name_color FROM colors WHERE id = $id_color");
                                              foreach ($colors as $color) {
                                                 echo $color;
                                              };
                                             ?></p>
                                       </span>
                                    </div>
                                 </div>
                           </div>
                           </td>
                           <td>
                              <div style="font-weight: 600; margin-top: 30px;"> 
                                 <span> <?php echo number_format($items['price'],0,',') . 'VNĐ';?></span>
                              </div>
                           </td>
                           <td>
                                 <div class="d-flex  justify-content-center btn-cart">
                                             <button type="button" class="drop"  onclick="decreaseQuantity(<?php echo $items['id'];?>)">
                                                   <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                      <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                                                   </svg>
                                             </button>
                                                <input type="button" class="quantity"  id="quantityInput<?php echo $items['id'];?>"  value="<?php echo $items['quantity']; ?>">
                                                <input type="hidden"  class="id" value="<?php echo $items['id'];?>">
                                                <input type="hidden"  class="price" id="<?php echo $items['id'];?>" value="<?php echo $items['price'];?>">
                                             <button type="button" class="plus" id="plus"  onclick="increaseQuantity(<?php echo $items['id'];?>)">
                                                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                   <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                                </svg>
                                             </button>
                                 </div>
                           </td>
                           <td>
                                    <input type="hidden"  class="id" value="<?php echo $items['id'];?>">
                                    <button style="background-color: white;" class="remo">
                                       <svg  style=" margin-top: 35px; color:red;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                       </svg>
                                    </button>
                           </td>
                        </tr>
                        <?php endforeach;?>
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="col-4">
               <div class="box-right-cart">
                  <div class="d-flex justify-content-between p-3 cart">
                     <h3>Giỏ hàng</h3>
                     <p style="font-size: 23px; font-weight:bold;" id="count"></p>
                  </div>
                  <div class="banner-cart">
                     <img src="https://media.canifa.com/attribute/swatch/c/a/canifa50_tagdetail_desktop-05oct.webp" alt="" srcset="">
                  </div>
                  <div class="d-flex justify-content-between ps-2 px-2 pt-3">
                     <p style="font-weight: 400; color:gray; margin-bottom: 5px;">Tổng tiền:</p>
                     <p style ="font-weight: 600; color: black;  margin-bottom: 5px;" class="total">0 VNĐ
                     </p>
                  </div>
                  <div class="d-flex justify-content-between ps-2 px-2" >
                     <p style="font-weight: 400; color:gray;  margin-bottom: 5px;">Giảm trực tiếp:</>
                     <p style ="font-weight: 600; color: red;  margin-bottom: 5px;">0 VNĐ</p>
                  </div>
                  <div class="d-flex justify-content-between ps-2 px-2" >
                     <p style="font-weight: 400; color:gray; margin-bottom: 5px;">Giảm qua Voucher:</>
                     <p style ="font-weight: 600; color: red; margin-bottom: 5px;">0 VNĐ</p>
                  </div>
                  <p class="d-flex  ps-2 px-2 pt-3" >
                     <a class="btn" style="width: 100%; height:35px; background-color: red; color:white; text-align: start;"  data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <span>Áp dụng ưu đãi để được giảm giá</span>
                        <svg style="padding-bottom: 4px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-ticket-perforated" viewBox="0 0 16 16">
                           <path d="M4 4.85v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9z"/>
                           <path d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3zM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9z"/>
                        </svg>
                     </a>
                  </p>
                  <div class="collapse ps-2 px-2 " id="collapseExample">
                     <div class="card card-body">
                     <p style="color:red;">Bạn đang không có ưu đãi nào!!</p>
                     </div>
                  </div>
                  <hr class="ms-2 mx-2">
                  <div class="d-flex justify-content-between ps-2 px-2" >
                     <p style="font-weight: 600; color:black; margin-bottom: 5px; font-size:25px;">Thành Tiền</p>
                     <p style ="font-weight: 600; color: black; margin-bottom: 5px; font-size:25px;" id="last-total">0 VNĐ</p>
                  </div>
                  <div class="check ms-2 mx-2 mt-3 mb-4"> 
                        <input type="hidden" class="id" value="<?php echo $user_id;?>">
                        <input class="checkOutBtn" type="button" value="Thanh Toán">
                  </div>
               </div>
            </div>
         </div>
   </div>
</div>
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
<script>
   //checkBox
        const selectAllCheckbox = document.getElementById('select-all');
        const itemCheckboxes = document.querySelectorAll('.select-item');

        selectAllCheckbox.addEventListener('change', function() {
            itemCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        itemCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (document.querySelectorAll('.select-item:checked').length === itemCheckboxes.length) {
                    selectAllCheckbox.checked = true;
                } else {
                    selectAllCheckbox.checked = false;
                }
            });
        });
   //quantity
   // Hàm để giảm số lượng
        var newQuanti = '';
         function decreaseQuantity(itemsId) {
                  var input = document.getElementById("quantityInput" + itemsId );
                  var currentValue = parseInt(input.value);

                  if (currentValue > 0) {
                     input.value = currentValue -1;
                  }
                  newQuanti = input.value;
                  if (newQuanti == 0) {
                     var confirmDelete = confirm('Số lượng tối thiểu phải là 1');
                     if (confirmDelete) {
                        input.value = currentValue;
                        newQuanti = input.value;
                     }
                  }
            }
        // Hàm để tăng số lượng
        function increaseQuantity(itemsId) {
            var input = document.getElementById("quantityInput" + itemsId);
            var currentValue = Number(input.value);
            input.value = currentValue + 1;
            newQuanti =input.value;

        }
        
        // JQuery
        $(document).ready(function () {
         $(".plus").click(function (e) { 
            e.preventDefault();
            var boxquanti = $(this).parent();
            var soluong = boxquanti.children("input").eq(0).val();
            var id_pro = boxquanti.children("input").eq(1).val();
            var prices = [];
            $('.price').each(function(index) {
               var priceValue = $(this).val(); 
               var quantityValue = $('.quantity').eq(index).val(); 

               prices.push({
                  price: priceValue, 
                  quantity: quantityValue
               });
            });
            $.ajax({
               type: "POST",
               url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=carts&action=add",
               data: {
                  soluong:soluong,
                  id_pro:id_pro,
                  prices:prices,
               },
               cache:false,
               // success: function(response) {
               //    $('.total').html(response); 
               // }
            });
         });
        });
        $(document).ready(function () {
         $(".drop").click(function (e) { 
            e.preventDefault();
            var boxquanti = $(this).parent();
            var soluong = boxquanti.children("input").eq(0).val();
            var id_pro = boxquanti.children("input").eq(1).val();
            var prices = [];
            $('.price').each(function(index) {
               var priceValue = $(this).val(); 
               var quantityValue = $('.quantity').eq(index).val(); 

               prices.push({
                  price: priceValue, 
                  quantity: quantityValue
               });
            });
            $.ajax({
               type: "POST",
               url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=carts&action=drop",
               data: {
                  soluong:soluong,
                  id_pro:id_pro,
                  prices:prices,
               },
               cache:false,
               // success: function(response) {
               //    $('.total').html(response); 
               // }
            });
         });
        });
        //delete
        function remo() {
         $(document).ready(function () {
         $(".remo").click(function (e) { 
            e.preventDefault();
            var tr = $(this).parent().parent();
            var boxquanti = $(this).parent();
            var id_pro = boxquanti.children("input").eq(0).val();
            tr.remove();
            $.ajax({
               type: "POST",
               url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=carts&action=deleteOrder",
               data: {
                  id_pro:id_pro,
               },
               cache:false,
               // success: function (res) {
               //    var resx = JSON.parse(res);
               //    console.log('reessssss', resx, resx.name)
               // }
            });
         });
        });
        }
        
        //
        //checkout
        $(document).ready(function () {
         $(".checkOutBtn").click(function (e) { 
            e.preventDefault();
            var selectedProducts = [];
                  $('input[name="checkbox"]:checked').each(function() {
                     var id = $(this).val();
                    
                     selectedProducts.push({
                        id:id,
                     });
                  });
                  if (selectedProducts.length > 0) {
                     $.ajax({
                           type: "POST",
                           url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=orders&action=add",
                           data: {
                              products: selectedProducts
                           },
                           cache:false,
                           success: function(response) {
                              window.location.href = 'http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=home&action=checkout';
                           }
                        });
                  } else {
                     alert("Vui lòng chọn ít nhất một sản phẩm.");
                  }
               });
        });
         //gửi id checked
        $(document).ready(function() {
            var selectedProducts = [];
            $('.select-item').change(function() {
               var productId = $(this).val();
               if ($(this).is(':checked')) {
                     selectedProducts.push(productId);
               } else {
                     var index = selectedProducts.indexOf(productId);
                     if (index > -1) {
                        selectedProducts.splice(index, 1);
                     }
               }
            $('.plus').click(function() {
               $('.select-item').prop('checked', false);
                  var index = selectedProducts.indexOf(productId);
                     if (index > -1) {
                        selectedProducts.splice(index, 1);
                     }
            });
            $('.drop').click(function() {
               $('.select-item').prop('checked', false);
                  var index = selectedProducts.indexOf(productId);
                     if (index > -1) {
                        selectedProducts.splice(index, 1);
                     }
            });
               $.ajax({
                     url: 'http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=orders&action=clickCheckBox',
                     type: 'POST',          
                     data: {
                        id: selectedProducts,     
                     },
                     success: function(response) {
                        $('.total').html(response); 
                        $('#last-total').html(response); 
                     },
               });
            });
         });
    </script>
<?php
layouts('footers/footer-view-user')
?>