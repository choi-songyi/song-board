<?php
include '../lib/lib.php';

$id = $_SESSION['id'];
$comment = mysqli_real_escape_string($conn,$_POST['comment']);
$content_number = $_POST['content_number'];


$comment_query = "INSERT INTO comments (content_number,user_id,comment,time) VALUES('$content_number','$id','$comment',NOW())";
$result = mysqli_query($conn,$comment_query);

if($result){
    header('location:../board/detail.php?idx='.$content_number);
} 

?>