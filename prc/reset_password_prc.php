<?php
include '../lib/lib.php';
require_once '../lib/header.php';

$id = mysqli_real_escape_string($conn,$_POST['user_id']);
$email = mysqli_real_escape_string($conn,$_POST['email']);

$find_query = "SELECT * FROM member WHERE user_id = '$id' AND email = '$email'";
$result = mysqli_query($conn,$find_query);
$data = mysqli_fetch_array($result);
$id = $data['user_id'];

if($data){
    echo '<div class="login-form">
    <form action="reset_password_prc2.php" method="POST">
        <h2 class="text-center">비밀번호 변경</h2>   
        <input type="hidden" name="id" value="'.$id.'">    
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="변경할 비밀번호를 입력하세요">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">변경하기</button>
        </div>
    </form>
    <p class="text-center"><a href="../member/login.php">로그인</a></p>
</div>';

} else{
    echo '해당하는 아이디 또는 이메일이 없습니다. 
    <a href="../member/reset_password.php">아이디 또는 이메일을 확인해주세요<a>';
};

require_once '../lib/footer.php';
?>
