<?php
include '../lib/lib.php';

$idx = $_POST['idx'];

$delete_query = "DELETE FROM board WHERE idx = $idx";
$result = mysqli_query($conn,$delete_query);
$comment_query = "DELETE FROM comments WHERE content_number = $idx";
$comment_result = mysqli_query($conn,$comment_query);


if($result){
    header('location:../index.php');
} else{
    echo '삭제하는 과정 중에 문제가 발생했습니다';
}

?>
