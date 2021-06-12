<?php
include '../lib/lib.php';
require_once '../lib/header.php';

$idx = $_GET['idx'];
$title = '';
$time = '';
$contents = '';
$name = '';
$delete_btn = '';
$update_btn = '';
$login = '';
$comment_container = '';
$delete_comment = '';

$detail_query = "SELECT * FROM board WHERE idx=$idx";
$result = mysqli_query($conn,$detail_query);
$data = mysqli_fetch_array($result);
$views = $data['views'];

$comment_query = "SELECT * FROM comments WHERE content_number=$idx";
$comment_result = mysqli_query($conn,$comment_query);

if(isset($_GET['idx'])){
    $title = $data['title'];
    $time = $data['time'];
    $contents = $data['contents'];
    $name = $data['user_id'];
    
    $views = $views+1;
    $view_query = "UPDATE board SET views=$views WHERE idx=$idx";
    $view_result = mysqli_query($conn,$view_query);

    while($comment_data = mysqli_fetch_array($comment_result)){
        $comment_id = $comment_data['user_id'];
        if($comment_id === $_SESSION['id']){
            $delete_comment = '<form action="../prc/delete_comment_prc.php" method="POST">
            <input type="hidden" name="content_number" value="'.$idx.'">
            <input type="hidden" name="idx" value="'.$comment_data['idx'].'">
            <button type="submit" class="" onclick="return submitForm()">삭제하기</button>
            </form><button type="" class="" onclick="update_comment()">수정하기</button>';
            $update_comment = '';
        }
        $comment_id = $comment_data['user_id'];
        $comment = $comment_data['comment'];
        $comment_time = $comment_data['time'];
        $comment_container = $comment_container.'<div class="container3">
        <p>'.$comment_id.'</p>
        <p>'.$comment.'</p>
        <p>'.$comment_time.'</p>
        <span>'.$update_comment.$delete_comment.'</span></div>';
        };

    if($_SESSION['isLogin']=='true'){
        $comment_btn ='<form action="../prc/create_comment_prc.php" method="POST" name="comment_form">
        <div class="form-group">
            <h5>댓글</h5>
            <textarea style="height:20px"class="form-control" name="comment"  placeholder="댓글을 입력해주세요"></textarea>
        </div>
        <input type="hidden" class="form-control" name="content_number" value="'.$idx.'">
        <button type="submit" onclick="return submitComment()">댓글달기</button>
        </form>';
    } else {
        $comment_btn ='<form action="" method="POST" name="comment_form">
        <div class="form-group">
            <h5>댓글</h5>
            <textarea style="height:20px"class="form-control" name="comment"  placeholder="로그인 후 이용해주세요"></textarea>
        </div>
        <button type="" onclick="alert(\'로그인 후 이용해주세요\')">댓글달기</button>
        </form>';
        $login = '<a href="../member/login.php">로그인</a>';
    };

    if($name === $_SESSION['id']){
        $delete_btn = '<form action="../prc/delete_prc.php" method="POST">
        <input type="hidden" name="idx" value="'.$idx.'">
        <button type="submit" class="custom" onclick="return submitForm()">삭제하기</button>
        </form>';
        $update_btn = '<form action="../board/update.php" method="POST">
        <input type="hidden" name="idx" value="'.$idx.'">
        <input type="hidden" name="title" value="'.$title.'">
        <input type="hidden" name="contents" value="'.$contents.'">
        <button type="submit" class="custom">수정하기</button>
        </form>';
    } else {$delete_btn = '';};   
    
};
?>

<script>
  function submitForm(){
    var check = confirm('정말 삭제하시겠습니까?');
 if(check){
     return true;
 } else{
     return false;
 }
 document.login_form.submit(); 
};

function submitComment(){
 if(!document.comment_form.comment.value){
     alert('댓글을 입력해주세요');
     return false;
 } 
 document.comment_form.submit(); 
};
function update_comment(){
   alert('업데이트 구현 해야함');
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
<?=$comment_container?>
<div class="container">
    <?=$comment_btn?>
</div>
<?=$delete_btn?>
<?=$update_btn?>
<a href="../index.php">돌아가기</a>
<?=$login?>
<?php require_once '../lib/footer.php';?>


