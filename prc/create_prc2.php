<?php
include '../lib/lib.php';

$query = "SELECT * FROM board ORDER BY idx DESC LIMIT 1";
$result = mysqli_query($conn,$query);
$data=mysqli_fetch_array($result);
$group_num = $data['idx'];

// 넘어온 그룹넘버가 0이라면 자기 자신으로 그룹넘버 저장
if($data['group_num']==0){
    $update_query = "UPDATE board SET group_num = '$group_num' WHERE idx='$group_num'";
    $update_result = mysqli_query($conn,$update_query);
    if($update_result){
        header('location:../index.php');
    } else{
        require_once '../lib/header.php';
        echo '<p class="text-center">저장하는 과정에서 문제가 발생했습니다. <br><a href=../board/create.php>다시 작성해주세요</a></p>';
        require_once '../lib/footer.php';
    }
} else{
    header('location:../index.php');
}


?>