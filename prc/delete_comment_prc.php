<?php
include '../lib/lib.php';
$content_number = $_POST['content_number'];
$idx = $_POST['idx'];
$delete_comment_query = "DELETE FROM comments WHERE idx = '$idx'";
$result = mysqli_query($conn,$delete_comment_query);
// $data = mysqli_fetch_array($result);

if($result){
    header('location:../board/detail.php?idx='.$content_number);
};
?>
