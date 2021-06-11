<?php
include 'lib.php';

$title = mysqli_real_escape_string($conn,$_POST['title']);
$contents = mysqli_real_escape_string($conn,$_POST['contents']);
$id = $_SESSION['id'];

$create_query = "INSERT INTO board (title,contents,time,user_id,views) VALUES('$title','$contents',NOW(),'$id','0')";
$result = mysqli_query($conn,$create_query);

if($result){
    header('location:index.php');
} else{
    require_once 'header.php';
    echo '<p class="text-center">저장하는 과정에서 문제가 발생했습니다. <br><a href=create.php>다시 작성해주세요</a></p>';
    require_once 'footer.php';
}

?>
