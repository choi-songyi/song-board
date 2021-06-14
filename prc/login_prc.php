<?php
include '../lib/lib.php';


$id = mysqli_real_escape_string($conn,$_POST['user_id']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

$login_query = "SELECT * FROM member WHERE user_id='$id' AND password=password('$password')";
$result = mysqli_query($conn,$login_query);
$data = mysqli_fetch_array($result);


if(isset($data)){
    if($data['active']=='0'){
        echo '이메일 인증을 완료해주세요';
    } else if($data['active']=='1'){
        $_SESSION['isLogin'] = 'true';
        $_SESSION['id'] = $id;
        header('location:../prc/check_login.php');
    } ;  
} else{
    require_once '../lib/header.php';
    echo '<p class="text-center">아이디 또는 비밀번호가 틀렸습니다<br><a href=../member/login.php>다시 로그인해주세요</a></p>';
    require_once '../lib/footer.php';
}



?>