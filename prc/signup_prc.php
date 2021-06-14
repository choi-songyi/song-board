<?php
include '../lib/lib.php';

$id = $_GET['id'];

if(!isset($id)){
    echo '잘못된 접근입니다';
}

$signup_query = "UPDATE member SET active = '1' WHERE user_id = '$id'";
$result = mysqli_query($conn,$signup_query);

if($result){
    echo '<p class="text-center">회원가입을 축하합니다! <a href=../member/login.php>로그인 하기</a></p>';
} else{
    echo '<p class="text-center">이메일 인증 과정 중에 문제가 발생했습니다</p>';
    // echo mysqli_error($conn);
}
?>