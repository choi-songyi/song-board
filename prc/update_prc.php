<?php include '../lib/lib.php';
require_once '../lib/header.php';


$idx =$_POST['idx'];
$title = mysqli_real_escape_string($conn,$_POST['title']);
$contents = mysqli_real_escape_string($conn,nl2br($_POST['contents']));

$update_query = "UPDATE board SET title = '$title', contents = '$contents' WHERE idx='$idx'";
$result = mysqli_query($conn,$update_query);

if($result){
    header('location:../board/detail.php?idx='.$idx);
} else{
    echo mysqli_error($conn);
}
?>

<?php require_once '../lib/footer.php';?>