<?php
include '../lib/lib.php';

// 댓글 남기는 아이디랑 내용, 해당 글의 인덱스, 댓글 부모 값
$id = $_SESSION['id'];
$comment = mysqli_real_escape_string($conn,$_POST['comment']);
$content_number = $_POST['content_number'];
$parent = $_POST['parent'];


// 댓글 부모 값의 그룹 넘버 찾아서 스레드 계산 (총 50개까지 작성 가능)
$find_query = "SELECT * FROM comments WHERE idx = '$parent'";
$find_result = mysqli_query($conn,$find_query);
$find = mysqli_fetch_array($find_result);
$group_num = $find['group_num'];
$count_query = "SELECT * FROM comments WHERE group_num = '$group_num'";
$count_result = mysqli_query($conn,$count_query);
$count = mysqli_num_rows($count_result);
$thread = 50-$count;

if($thread==0){
    echo '작성 가능한 최대 댓글 갯수를 초과했습니다<a href="location:../board/detail.php?idx='.$content_number.'">돌아가기</a>';
} else{
    // 그룹 넘버가 있다면 동일한 번호로 그룹 넘버 저장,스레드 저장
    if(isset($group_num)){
        $comment = '└ RE :'.$comment;
        $group_num = 
        $comment_query = "INSERT INTO comments (content_number,user_id,comment,time,group_num,thread) VALUES('$content_number','$id','$comment',NOW(),'$group_num','$thread')";
        $result = mysqli_query($conn,$comment_query);
        header('location:../board/detail.php?idx='.$content_number);
    } else{
        // 없다면 자기 자신으로 그룹 넘버 저장
        $comment_query = "INSERT INTO comments (content_number,user_id,comment,time) VALUES('$content_number','$id','$comment',NOW())";
        $result = mysqli_query($conn,$comment_query);
        $group_num = mysqli_insert_id($conn);
        $query = "UPDATE comments SET group_num = '$group_num' WHERE idx = '$group_num'";
        $Uresult = mysqli_query($conn,$query);
    };
};

if($Uresult){
    header('location:../board/detail.php?idx='.$content_number);
}

?>