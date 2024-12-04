<!-- Chức năng quản lý người dùng:
P1: Xác thực truy cập
 -Đăng Nhập
 -Đăng Ký 
 -Đăng Xuất
 -Quên mật khẩu
 -Kích Hoạt Tài Khoản 
P2: Quản lý người dùng
 - Kiểm tra người dùng đăng nhập
 - Thêm người dùng
 - Sửa và xóa người dùng
 - Hiện thị danh sách người dùng hiện đang có
 - Phân trang hiển thị
 - Tìm kiếm thông tin người dùng, lọc dữ liệu
P3: Thiết kế DB:
***ADMIN:
 ** users:
    + id: primary key (int)
    + fullname (varchar(100))
    + email (varchar(100))
    + phone (varchar(20))
    + password (varchar(50))
    + fogotToken (varchar(100)) lấy lại mật khẩu, khôi phục tài khoản
    + ativeToken (varchar(100))
    + status(int)
    + role(int)
    + create_at (datetime)
    + update_at (datetime)
 - logintoken:
    + id - primary key (int)
    + user_ID (int)
    + token (varchar(100)) 
    + create_at (datetime)
 **products
    + id: primaryKey(int)
    + name(varchar(255))
    + image(varchar(255))
    + description(varchar(255))
    + create_at(datetime)
    + update_at(datetime)
 **categories
    + id:primaryKey(int)
    + name(varchar(255))
    + create_at(datetime)
    + update_at(datetime)
 **colors
    + id:primaryKey(int)
    + name(varchar(255))
    + color_code(varchar(255))
    + create_at(datetime)
 **sizes
    + id:primaryKey(int)
    + name(varchar(25))
    + create_at(datetime)
 **variant_product
    +id:primaryKey
    +product_id(int) khóa ngoại liên kết với bảng pro
    +color_id(int)
    +size_id(int)
    +cate_id(int)
    +image(varchar(255))
    +stock_quantity(int) - số lượng có sẵn
    +variant_price - giá bán từng biến thể
    +create_at (datetime)
    _update_at(date_time)
** Chức năng đăng ký tài khoản
 - đĂNG Ký( kiểm tra và insert dữ liệu vào bảng users)
 - Gửi mail đăng ký kích hoạt tài khoản cho người dùng
 - Bấm vào đường link kích hoạt tài khoản hoặc sử dụng OTP
** Chức năng quên mật khẩu
 - Tạo forgotToken
 - Gửi mail chứa link đến trang reset
 - Xác thực token, hiện ra form reset password
 - Submit reset password -> xử lý -> update password
 -->


