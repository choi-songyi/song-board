<?php
include 'lib.php';
require_once 'header.php';

$idx = $_GET['idx'];
$title = '';
$time = '';
$contents = '';
$name = '';
$delete_btn = '';
$update_btn = '';

$detail_query = "SELECT * FROM board WHERE idx=$idx";
$result = mysqli_query($conn,$detail_query);
$data = mysqli_fetch_array($result);
$views = $data['views'];

if(isset($_GET['idx'])){
    $title = $data['title'];
    $time = $data['time'];
    $contents = $data['contents'];
    $name = $data['user_id'];
    
    $views = $views+1;
    $view_query = "UPDATE board SET views=$views WHERE idx=$idx";
    $view_result = mysqli_query($conn,$view_query);

    if($name === $_SESSION['id']){
        $delete_btn = $delete_btn.'<form action="delete_prc.php" method="POST">
        <input type="hidden" name="idx" value="'.$_GET['idx'].'">
        <input type="hidden" name="delete" id="delete" value="default">
        <button type="submit" class="custom" onclick="delete_msg()">삭제하기</button>
    </form>';
         $update_btn = $update_btn.'<form action="update.php" method="POST">
        <input type="hidden" name="idx" value="'.$_GET['idx'].'">
        <input type="hidden" name="title" value="'.$title.'">
        <input type="hidden" name="contents" value="'.$contents.'">
        <button type="submit" class="custom">수정하기</button>
    </form>'
    ;
    } else {
        $delete_btn = '';
    };
  
}
?>

<script>
    function delete_msg(){
    var check = confirm('정말 삭제하시겠습니까?');
     if(check){
        document.getElementById("delete").value = "YES";
     } else{
        document.getElementById("delete").value = "NO";
     }
    }
</script>

<h3>자유게시판</h3>
<div class="container">
    <h3><?=$title?></h3><br>
    <?=$name?> | <?=$time?>
</div>
<div class="container2">
    <p><?=$contents?></p> 
</div>
<?=$delete_btn?>
<?=$update_btn?>
<a href="index.php">돌아가기</a>
<?php require_once 'footer.php';?>