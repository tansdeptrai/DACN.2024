<?php
 if (!defined('_CODE')) { // check _code có tồn tại không
    die('Access denied...');
}
//Thông tin kết nối
const _HOST = 'localhost';
const _DB = 'mysql_php';
const _USER = 'root';
const _PASS = '';
try {
    if (class_exists('PDO')) {
        $dsn = 'mysql:dbname='._DB.'; host='._HOST;
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', //set utf8
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //tạo thông báo ra ngoại lệ khi gặp lỗi

        ];
        $conn = new PDO($dsn,_USER,_PASS, $options); 
    }
} catch (Exception $exception) {
    echo '<div style="color:red; padding: 5px 15px; boder:1px solid:red;">';
    echo $exception->getMessage(). '<br>';
    echo '</div>';
    die();
}