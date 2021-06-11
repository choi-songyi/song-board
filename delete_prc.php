<?php
include 'lib.php';

$prev_page = $_SERVER['HTTP_REFERER'];
$idx = $_POST['idx'];

$delete_query = "DELETE FROM board WHERE idx = $idx";
$result = mysqli_query($conn,$delete_query);


if($_POST['delete'] == 'NO'){
    header('location:'.$prev_page);
} else if($result){
    header('location:index.php');
} else{
    echo '삭제하는 과정 중에 문제가 발생했습니다';
}

?>
