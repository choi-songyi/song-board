<?php
include 'lib.php';

$id = mysqli_real_escape_string($conn,$_POST['user_id']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$name = mysqli_real_escape_string($conn,$_POST['user_name']);
// $hash = mysqli_real_escape_string($conn,md5(rand(0,1000)));
// $temp_password = mysqli_real_escape_string($conn,rand(1000,5000));

$signup_query = "INSERT INTO member (user_id,password,email,user_name) VALUES('$id','password($password)','$email','$name')";
$result = mysqli_query($conn,$signup_query);

if($result){
    // $to = $email; 
    // $subject = 'Signup | Verification';
    // $message = ' Thanks for signing up!
    //             Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
    //             ------------------------
    //             Username: '.$name.'
    //             Password: '.$temp_password.'
    //             ------------------------
    //             Please click this link to activate your account:
    //             https://project-songyi.herokuapp.com/verify.php?email='.$email.'&hash='.$hash.'';                  
    // $headers = 'From:noreply@project-songyi.herokuapp.com\r\n'; 
    // $check = mail($to, $subject, $message, $headers); 
    // if($check){
    //     echo "mail success";
    //     }else  {
    //     echo "mail fail";
    //    }
    echo '<p class="text-center">회원가입을 축하합니다! <a href=login.php>로그인 하기</a></p>';
} else{
    echo '<p class="text-center"><a href=signup.php>중복된 아이디 또는 이메일 입니다</a></p>';
    // echo mysqli_error($conn);
}
?>