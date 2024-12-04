<?php
if (!defined('_CODE')) {
    die('Access defined...');
}
//Truy vấn thông tin của categories
$filterAll = filter();
if (!empty($filterAll['id'])) {
    $pro_id = $filterAll['id'];
    $detailProducts = oneRaw("SELECT * FROM products WHERE id = $pro_id");
    $variantPro = getRaw("SELECT id,image, quantity, color_id, size_id, price FROM variant_products WHERE product_id = $pro_id");
    // colors
    $listColors = getRaw("SELECT * FROM colors");
    
    //Sizes
    $listSizes = getRaw("SELECT * FROM sizes");
}
$data = [
    'pageTitle' => 'Thêm mới sản phẩm',
];
layouts('headers/header-login', $data);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container">
    <div class="row">
        <h2 class="text-center text-uppercase">Thay Đổi Thông Tin Sản Phẩm</h2>
        <?php
             if(!empty($smg)){
                getSmg($smg, $smg_type);
              }
        ?>
    </div>
        <div class="row">
            <div class="col">
                <div class="from-group mg-form">
                    <label for="">Tên Sản Phẩm:</label>
                    <input disabled type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="<?php echo $detailProducts['name'];?>">
                </div>
                <div class="from-group mg-form">
                    <label for="">Mã Sản Phẩm</label>
                    <input disabled type="text" class="form-control" name="code_pro" placeholder="Tên sản phẩm" value="<?php echo $detailProducts['code_pro'];?>">
                </div>
              <div class="d-flex">
              <div class="from-group mg-form">
                    <label for="">Thông Tin Sản Phẩm:</label><br>
                    <textarea disabled name="description" id="" rows="15" cols="82" wrap="hard"><?php echo $detailProducts['description'];?></textarea>
                    
                </div>
                <div class="from-group mg-form mx-5">
                    <label for="">Hướng Dẫn Sử Dụng:</label><br>
                    <textarea disabled name="use_pro" id="" rows="15" cols="82" wrap="hard"><?php echo $detailProducts['use_pro'];?></textarea>
                   
                </div>
              </div>
              <div class="row">
                <div class="col from-group mg-form">
                    <label for="">Hình Ảnh Biến Thể</label>
                    <input id="imageMain"  type="file" class="form-control" name="image" placeholder="Lựa chọn hình ảnh" value="" accept="image">
                    <img id="imagePreview" src="" alt="Xem trước hình ảnh" style="width: 100px; height:auto; margin-top: 10px;">
                    
                </div>
                <div class="col from-group mg-form">
                    <form id="formImage">
                        <label for="">Hình Ảnh Chi Tiết</label>
                        <input id="imageInput" type="file" class="form-control" name="image[]" placeholder="Lựa chọn hình ảnh" multiple accept="image/*">
                        <div class="mt-2" id="preview"> 
                            <!-- Hiển thị ảnh đã chọn -->
                        </div>
                    </form>
                </div>
              </div>
              
              <div class="row">
                <label for="">Kích Thước & Màu :</label>
                <div class="col m-2" style="border: 2px solid gray; border-radius: 5px;">   <!-- Hiển thị biến thể sản phẩm -->
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Size</th>
                            <th scope="col">Màu</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Giá Thành</th>
                            <th scope="col">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            foreach ($variantPro as $vp):
                                $count ++;
                                $size_id = $vp['size_id'];
                                $color_id = $vp['color_id'];
                                $colors = getRaw("SELECT id, name_color, color_code FROM colors WHERE id = $color_id");
                                $sizes = getRaw("SELECT name_size, id FROM sizes WHERE id = $size_id");
                                foreach ($sizes as $size):
                                    foreach($colors as $color):
                            ?>
                                <tr>
                                <th scope="row"><?php echo $count;?></th>
                                <td><img src="uploads/<?php echo $vp['image'];?>" width="30px" height="auto"></td>
                                <td><?php echo $size['name_size'];?></td>
                                <td class="d-flex">
                                    <p style="margin-right: 10px;"><?php echo $color['name_color'];?></p>
                                    <div style="height: 25px; width: 25px; border:1px solid gray; border-radius: 1%; background-color: <?php echo $color['color_code'];?>;"></div>
                                </td>
                                <td>
                                    <div class="quantity-container">
                                        <button class="decrease btnDrop" data-id="<?php echo $vp['id'];?>">-</button>
                                        <input type="text" class="quantityPopup" id="quantity<?php echo $vp['id'];?>"  value="<?php echo $vp['quantity'];?>">
                                        <button class="btnPlus increase"  data-id="<?php echo $vp['id'];?>">+</button>
                                        <input type="hidden" class="idVariant" value="<?php echo $vp['id'];?>">
                                    </div>

                                </td>
                                <td><?php echo number_format($vp['price'],0,',') ." ". 'VNĐ'?></td>
                                <td>
                                <svg class="tras" data-id="<?php echo $vp['id'];?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                                </td>
                                </tr>
                            <?php
                                    endforeach;
                                endforeach;
                            endforeach;
                            ?>   
                        </tbody>
                    </table>
                    
                </div>
                <div class="col">           <!-- khu vực thêm biến thể biến thể cho sản phẩm -->
                
                <div class="from-group mg-form">
                    <label for="">Màu Sắc:</label>
                    
                    <select name="color_id" id="colorId" class="form-control">
                    <option>--- Chọn Màu Sắc ---</option>
                    
                    <?php
                        foreach ($listColors as $items):
                        ?>
                        <option class="color" data-id="<?php echo $items['id'];?>" value="<?php echo $items['id']?>"><?php echo $items['name_color']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="from-group mg-form">
                    <label for="">Size:</label>
                    <select name="size_id" id="sizeId" class="form-control">
                    <option>--- Chọn Kích Thước ---</option>
                    <?php 
                        foreach ($listSizes as $items):
                    ?>
                        <option class="size" data-id="<?php echo $items['id'];?>" value="<?php echo $items['id']?>"><?php echo $items['name_size']?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="from-group mg-form">
                    <label for="">Giá Bán:</label>
                    <input type="text" class="form-control price" name="price" placeholder="Giá bán sản phẩm" value="">
                </div>
                <div class="from-group mg-form">
                    <label for="">Số Lượng:</label>
                    <input type="text" class="form-control quantity" name="quantity" placeholder="Số lượng sản phẩm" value="">
                </div>
                </div>
              </div>
              <!-- Pobhub add to cart -->
            <div id="overlay"></div>
            <div class="popup" id="popup" style="width: 200px; height:auto;">
                <div class="d-flex justify-content-between">
                    <p style="color: black; font-weight: bold;">CANIFA - ADMIN</p>
                    <svg id="closePopup" class="mt-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                </div>
                <div style="align-items: center; text-align: center;">
                    <svg style="color: green;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                    </svg>
                    <p class="mess" style="color: greenyellow;"></p>
                </div>
            </div>
            <!-- end pobhub -->
            </div>
        </div>
        <input type="hidden"  id="idCate" value="<?php echo $detailProducts['cate_id'];?>">
        <input type="hidden" id="idProduct" name="id" value="<?php echo $pro_id?>"> <!-- id product -->
        <button type="button" class="btn btn-primary btn-block mg-btn mt-4 addVp">Thêm Biến Thể</button>
        <p class="text-center mt-4"><a href="?module=products&action=list">Quay lại</a></p>
    </form>
</div>
<script>
        $(document).ready(function() {
            var imgDetail= [];     //img detail
            var img = '';          //img
            var formData = new FormData();
            // imgDetail
            var idvp = $(".idVariant").data('id');
            $('#imageInput').on('change', function() {
                $('#preview').empty(); 
                const files = this.files;
                for (var i = 0; i < files.length; i++) {
                    formData.append('images[]', files[i]);
                }
                
                if (files.length > 0) {
                    $.each(files, function(index, file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                    
                            const img = $('<img>').attr('src', e.target.result)
                                .css({
                                    'width': '70px',
                                    'height': '90px',
                                    'margin': '5px',
                                    'object-fit': 'cover'  
                                });
                            $('#preview').append(img);
                        };
                        reader.readAsDataURL(file);
                    });
                }
                
            });
            //img
                $('#imageMain').on('change', function(event) {
                    var file = event.target.files[0]; 
                    img = file;
                    if (file && file.type.startsWith('image/')) {
                        var reader = new FileReader(); 
                        reader.onload = function(e) {
                            $('#imagePreview').attr('src', e.target.result); 
                            $('#imagePreview').show(); 
                        };
                        reader.readAsDataURL(file); 
                        
                        
                    } else {
                        alert('Vui lòng chọn một tệp hình ảnh hợp lệ.');
                        $('#imagePreview').hide();
                    }
                });
            //xóa
            $(".tras").click(function (e) { 
                e.preventDefault();
                let id = $(this).data('id');
                alert('vào' + id);
            });
            //Tăng giảm số lượng
            $('.increase').click(function() {
                let idvp = $(this).data('id');
                var currentVal = parseInt($('#quantity'+ idvp).val());
                $('#quantity' + idvp).val(currentVal + 1);
                let quantity = $("#quantity"+idvp).val();
                console.log(quantity);
                
            });

            $('.decrease').click(function() {
                let idvp = $(this).data('id');
                var currentVal = parseInt($('#quantity' + idvp).val());
                if (currentVal > 1){ 
                $('#quantity' + idvp).val(currentVal - 1);
                let quantity = $("#quantity"+idvp).val();
                console.log(quantity);
                
                }else{
                    alert("Số lượng đã tối thiểu bạn có muốn xóa!!")
                }
            });
            // 
            // lấy color
            var idColor = '';
            $("#colorId").on('change', function () {
                idColor = $(this).val();
            });
            //lấy size
            var idSize = '';
            $("#sizeId").on('change', function () {
                idSize = $(this).val();
            });
            //
            $(".addVp").click(function (e) { 
                e.preventDefault();            
                let quantity = $(".quantity").val();                
                let price = $(".price").val(); 
                let idProduct = $("#idProduct").val();
                let idCate = $("#idCate").val();
                formData.append('image', img); 
                formData.append('idProduct', idProduct);
                formData.append('idCate', idCate);
                formData.append('idColor', idColor);
                formData.append('idSize', idSize);
                formData.append('price', price);
                formData.append('quantity', quantity);
                
                if (idColor && idSize && quantity && price && imgDetail && img && idProduct && idCate) {
                    $.ajax({
                        type: "POST",
                        url: "?module=products/actionVp&action=add",
                        data: formData,
                        contentType:false,
                        processData:false,
                        dataType: "json",
                        success: function (response) {
                            $("#overlay").fadeIn();
                            $("#popup").fadeIn();
                            if (response.success) {
                                $('.mess').text(response.success);
                            }else{
                                $('.mess').text(response.error);
                            }
                        }
                    });
                }else{
                    const checks = [
                        { value: idColor, message: "Chưa có màu?" },
                        { value: idSize, message: "Chưa có size?" },
                        { value: quantity, message: "Chưa có số lượng?" },
                        { value: price, message: "Chưa có giá?" },
                        { value: imgDetail, message: "Chưa có ảnh chi tiết?" },
                        { value: img, message: "Chưa có ảnh biến thể?" },
                    ];
                    checks.forEach(check => {
                        if ((!check.value && check.value !== 0) || (Array.isArray(check.value) && check.value.length === 0)) {
                            console.log(check.message);
                        }
                    });
                }
            });
            $("#closePopup, #overlay").click(function() {
                $("#overlay").fadeOut();
                $("#popup").fadeOut();
            });
        });
    </script>
<?php layouts('footers/footer-login');?>