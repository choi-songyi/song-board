<?php
include '../lib/lib.php';

$prevPage = $_SERVER['HTTP_REFERER'];

$comment = mysqli_real_escape_string($conn,nl2br($_REQUEST['comment']));
$idx = $_REQUEST['idx'];
$content_number = $_REQUEST['content_number'];

if(!$_REQUEST['comment'] || null){
    header('location:'.$prevPage);
} else{
    $query = "UPDATE comments SET comment='$comment' WHERE idx = $idx";
    $result = mysqli_query($conn,$query);
    if($result){
        header('location:../board/detail.php?idx='.$content_number);
    }
}

?>