<?php
include '../lib/lib.php';

// 로그인 성공하면 인덱스로 이동
if($_SESSION['isLogin']==='true'){
    header('location:../index.php');
   
} else{
    require_once '../lib/header.php';
    echo '<p class="text-center"><a href=../index.php>로그인이 필요합니다</a></p>';
    require_once '../lib/footer.php';
}

?>
