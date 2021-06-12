<?php
include '../lib/lib.php';

$password = mysqli_real_escape_string($conn,$_POST['password']);
$id = mysqli_real_escape_string($conn,$_POST['id']);

$update_query = "UPDATE member SET password = password('$password') WHERE user_id='$id'";
$result = mysqli_query($conn,$update_query);

if($result){
    echo'비밀번호가 변경되었습니다. 
    <a href="../member/login.php">로그인 하러가기</a>';

} else{
    echo '비밀번호를 변경하는 과정중에 문제가 발생했습니다
    <a href="../member/login.php">로그인 하러가기</a>';
}

?>