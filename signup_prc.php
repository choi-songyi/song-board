<?php
include 'lib.php';

$id = mysqli_real_escape_string($conn,$_POST['user_id']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$name = mysqli_real_escape_string($conn,$_POST['user_name']);
$hash = mysqli_real_escape_string($conn,md5(rand(0,1000)));
$temp_password = mysqli_real_escape_string($conn,rand(1000,5000));

$signup_query = "INSERT INTO member (user_id,password,temp_password,email,user_name,hash) VALUES('$id',password($password),'$temp_password','$email','$name','$hash')";
$result = mysqli_query($conn,$signup_query);

if($result){
    require_once 'header.php';
    $to = $email; 
    $subject = 'Signup | Verification';
    $message = ' Thanks for signing up!
                Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
                ------------------------
                Username: '.$name.'
                Password: '.$temp_password.'
                ------------------------
                Please click this link to activate your account:
                https://project-songyi.herokuapp.com/verify.php?email='.$email.'&hash='.$hash.'';                  
    $headers = 'From:noreply@project-songyi.herokuapp.com' . "\r\n"; 
    mail($to, $subject, $message, $headers); 
    echo '<p class="text-center">회원가입을 축하합니다! 이메일 인증을 완료해주세요 <a href=login.php>로그인 하기</a></p>';
    require_once 'footer.php';
} else{
    require_once 'header.php';
    echo '<p class="text-center"><a href=signup.php>중복된 아이디 또는 이메일 입니다</a></p>';
    require_once 'footer.php';
    // echo mysqli_error($conn);
}
?>