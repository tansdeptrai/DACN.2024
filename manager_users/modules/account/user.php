<?php
    $token = getSession('logintoken');
    $id_user = oneRaw("SELECT user_ID FROM logintoken WHERE token = '$token'");
    $user_id = $id_user['user_ID'];
    $user = oneRaw("SELECT id, fullname, sex, phone, email FROM users WHERE id =$user_id");

?>
<div>
    <div class="d-flex justify-content-center" id="success-editUser"></div>
    <span style="font-weight: bold; font-size: 20px;">Thông tin tài khoản</span>
    <div class="pt-3">
        <label style=" font-weight: 500;" for="">Giới tính</label>
        <div class="d-flex">
            <div class=" sex d-flex pt-2">
                <input type="radio" name="option" id="option" echo value="Nam">
                <span>Nam</span>
            </div>
            <div class=" sex d-flex pt-2">
                <input type="radio" name="option" id="option" value="Nữ">
                <span>Nữ</span>
            </div>
            <div class=" sex d-flex pt-2">
                <input type="radio" name="option" id="option" value="Khác">
                <span>Khác</span>
            </div>
            <input type="hidden" id="sex" value="<?php echo $user['sex'];?>">
        </div>
    </div>
    <div class="pt-3">
        <div class="mb-3">
            <label style=" font-weight: 500; " class="form-label">Họ và Tên :</label>
            <input type="text" id="fullname" class="form-control" placeholder="<?php echo $user['fullname']?>" value="<?php echo $user['fullname']?>">
        </div>
        <div class="mb-3">
            <label style=" font-weight: 500;" class="form-label">Địa chỉ Email :</label>
            <input type="text" id="email" class="form-control" placeholder="<?php echo $user['email'];?>" value="<?php echo $user['email'];?>">
        </div>
        <div class="mb-3">
            <label style=" font-weight: 500;" class="form-label">Số điện thoại :</label>
            <input type="text" id="phone" class="form-control" placeholder="<?php echo $user['phone'];?>" value="<?php echo $user['phone'];?>">
        </div>
        <input type="hidden" id="id" value="<?php echo $user['id'];?>">
        <button type="submit" id="editUser">Lưu Thay Đổi</button>
    </div>
</div>
<script>
    $(document).ready(function() {
    const selectedValue = $('#sex').val(); 
    $(`input[name="option"][value="${selectedValue}"]`).prop('checked', true);
    });
    $(document).ready(function () {
        $("#editUser").click(function (e) { 
            e.preventDefault();
            let fullname = $('#fullname').val();
            let email = $('#email').val();
            let phone = $('#phone').val();
            let sex = $('#option').val();
            let id_user = $("#id").val();
            $.ajax({
            type: "POST",
            url: "http://localhost/PHP3_CoBan/BaiTap/manager_users/?module=account/user&action=editUser",
            data: {
                id:id_user,
                fullname:fullname,
                email:email,
                phone:phone,
                sex:sex
            },
            success: function (response) {
                $('#success-editUser').append('<button style=" color:#00FF00;border: 1px; background-color:white; border-radius:10px; margin-bottom:10px;">'
                            + response +
                            '</button>');
            }
        });
        });
       
    });

</script>