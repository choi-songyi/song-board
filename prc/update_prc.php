<?php include '../lib/lib.php';
require_once '../lib/header.php';


$idx =$_REQUEST['idx'];
$title = mysqli_real_escape_string($conn,$_REQUEST['title']);
$contents = mysqli_real_escape_string($conn,nl2br($_REQUEST['contents']));

// 보드 테이블에서 해당 인덱스를 가진 행 내용 업데이트
$update_query = "UPDATE board SET title = '$title', contents = '$contents' WHERE idx='$idx'";
$result = mysqli_query($conn,$update_query);

if($result){
    header('location:../board/detail.php?idx='.$idx);
} else{
    echo mysqli_error($conn);
}
?>

<?php require_once '../lib/footer.php';?>