<?php include 'lib.php';
require_once 'header.php';


$idx =$_POST['idx'];
$title = mysqli_real_escape_string($conn,$_POST['title']);
$contents = mysqli_real_escape_string($conn,$_POST['contents']);

$update_query = "UPDATE board SET title = '$title', contents = '$contents' WHERE idx='$idx'";
$result = mysqli_query($conn,$update_query);

if($result){
    header('location:detail.php?idx='.$idx);
} else{
    echo mysqli_error($conn);
}
?>

<?php require_once 'footer.php';?>