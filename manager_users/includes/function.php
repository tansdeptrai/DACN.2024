
 <?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include 'database.php';

 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
 }
 function layouts($layoutName='header', $data=[]){
   if (file_exists( _WEB_PATH_TEMPLATES. '/layout/'.$layoutName.'.php')) {
      require_once _WEB_PATH_TEMPLATES. '/layout/'.$layoutName.'.php';
   }
 }
 //Hàm gửi mail
function sendMail($to, $subject, $content){

//Create an instance; passing `true` enables exceptions
   $mail = new PHPMailer(true);
   try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'huytansk98cc@gmail.com';                     //SMTP username
      $mail->Password   = 'qozd nruk qovt dzds';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      //Recipients
      $mail->setFrom('tanslunglinh@gmail.com', 'TanDz');
      $mail->addAddress($to);     //Add a recipient
      //Content
      $mail -> CharSet = "UTF-8";
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $content;
      //PHPMailer SSL certificate verify failed
      $mail->SMTPOptions = array(
         'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' =>false,
            'allow_self_signed' =>true
         )
      );
      $sendMail = $mail->send();
      if ($sendMail) {
         return $sendMail;
      }
      // echo 'Gửi đi thành công!!!!';
   } catch (Exception $e) {
      echo "Gửi đi thất bại!!!. Mailer Error: {$mail->ErrorInfo}";
   }
}
// Kiểm tra phương thức GET
function isGet(){
   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      return true;
   }
   return false;
}
// Kiểm tra phương thức POST
function isPost(){
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      return true;
   }
   return false;
}
// Hàm filter lọc dữ liệu
function filter(){
   $filterArr = [];
   if(isGet()){
      if(!empty($_GET)){
         foreach ($_GET as $key => $value) {
            $key = strip_tags($key);
            if (is_array($value)) {
               $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
            }else{
            $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
         }
      }
   }
   if(isPost()){
      if(!empty($_POST)){
         foreach ($_POST as $key => $value) {
            $key = strip_tags($key);
            if (is_array($value)) {
               $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
            }else{
            $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
         }
      }
   }
   return $filterArr;
}
//Kiểm tra email
function isEmail($email){
   $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
   return $checkEmail;
}
//Kiểm tra số nguyên int
function isNumberInt($number){
   $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
   return $checkNumber;
}
//Kiểm tra số thực float
function isNumberFloat($number){
   $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
   return $checkNumber;
}
//Kiểm tra số điện thoại
function isPhone($phone){
   $checkZero = false;
   if($phone[0] == '0'){
      $checkZero = true;
      $phone = substr($phone,1);
   }
   $checkNumber = false;
   if (isNumberInt($phone) && strlen($phone) == 9) {
      $checkNumber = true;
   }
   if ($checkNumber && $checkZero) {
      return true;
   }
   return false;
}
//Thông báo lỗi
function getSmg($smg, $type = 'success'){
   echo '<div class = "alert alert-'.$type.'">';
   echo $smg;
   echo '</div>';
}
//Hàm chuyển hướng
function redirect($path='index.php'){
   header("location: $path");
   exit;
}
// hàm thông báo lỗi
function form_erros($fileName, $erros, $beforeHtml='', $afterHtml=''){
   return (!empty($erros[$fileName])) ? $beforeHtml . reset($erros[$fileName]) . $afterHtml : null;
}
function oldData($filename, $oldData, $default = null){
   return (!empty($oldData[$filename])) ? $oldData[$filename] : $default; 
}
// Kiểm tra trạng thái đăng nhập
function isLogin(){
 $checkLogin = false;
 if (getSession('logintoken')) {
    $tokenLogin = getSession('logintoken');
    // ss 2 token với nhau
    $queryToken = oneRaw("SELECT user_ID FROM logintoken WHERE token = '$tokenLogin'");
    if (!empty($queryToken)) {
       $checkLogin = true;
    }else {
       removeSession('logintoken');
    }
 }
 return $checkLogin;
}
//
function flatten_array($array) {
   $result = [];
   foreach ($array as $value) {
       if (is_array($value)) {
           $result = array_merge($result, flatten_array($value));
       } else {
           $result[] = $value;
       }
   }
   return $result;
}
//List Product Home User-4
$detailPro = getRaw("SELECT vp.id, vp.product_id, vp.image, vp.color_id, vp.price, (p.name) AS product_name, p.code_pro, c.name_color, c.color_code, s.name_size, (d.name) AS cate_name
    FROM variant_products vp 
    INNER JOIN colors c ON vp.color_id =c.id
    INNER JOIN products p ON vp.product_id = p.id
    INNER JOIN sizes s ON vp.size_id =s.id
    INNER JOIN danhmuc d ON vp.cate_id = d.id WHERE vp.product_id = 31 ");





