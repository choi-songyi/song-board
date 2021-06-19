<?php
include '../lib/lib.php';


$id = mysqli_real_escape_string($conn,$_POST['user_id']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

// 아이디랑 비밀번호 비교
$login_query = "SELECT * FROM member WHERE user_id='$id' AND password=password('$password')";
$result = mysqli_query($conn,$login_query);
$data = mysqli_fetch_array($result);


if(isset($data)){
    // 이메일 인증 전이면 active가 0 
    if($data['active']=='0'){
        echo '이메일 인증을 완료해주세요';
        // 이메일 인증 후면 active가 1, 세션에 로그인, 아이디 저장
    } else if($data['active']=='1'){
        $_SESSION['isLogin'] = 'true';
        $_SESSION['id'] = $id;
        
        // 보드,코멘트 테이블에서 해당 아디를 가진 행 불러온 후 등급 계산
        $count_post_query = "SELECT * FROM board WHERE user_id='$id'";
        $count_post_result = mysqli_query($conn,$count_post_query);
        $count_post = mysqli_num_rows($count_post_result);
        $count_comments_query = "SELECT * FROM comments WHERE user_id='$id'";
        $count_comments_result = mysqli_query($conn,$count_comments_query);
        $count_comments = mysqli_num_rows($count_comments_result);
        $count = $count_post+($count_comments/2);
        if($count<=1){
            $level = 1;
        } else if($count<=4){
            $level = 2;
        } else if(5<=$count){
            $level = 3;
        };
        
        // 등급 계산 후 멤버 테이블에 정보 저장
        $level_query = "UPDATE member SET level = $level WHERE user_id = '$id'";
        mysqli_query($conn,$level_query);
        header('location:../prc/check_login.php');
    } ;  
} else{
    require_once '../lib/header.php';
    echo '<p class="text-center">아이디 또는 비밀번호가 틀렸습니다<br><a href=../member/login.php>다시 로그인해주세요</a></p>';
    require_once '../lib/footer.php';
}



?>