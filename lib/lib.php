<?php
session_start();

$conn = mysqli_connect(
    'us-cdbr-east-04.cleardb.com',
    'bc4786fbdccaf5',
    '249d8aed',
    'heroku_e68f10ad05c7a81'
);

mysqli_set_charset($conn,'utf8');

if(mysqli_connect_error()){
    echo 'mysql 접속 중 오류가 발생했습니다.';
    echo mysqli_error($conn);
};

header("Content-Type: text/html; charset=UTF-8");

// error_reporting(E_ALL);
// ini_set('display_errors','0');
?>
