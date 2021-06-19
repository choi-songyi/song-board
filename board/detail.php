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
$reply_post = '';

// 해당 인덱스를 가진 행 불러오기
$detail_query = "SELECT * FROM board WHERE idx=$idx";
$result = mysqli_query($conn,$detail_query);
$data = mysqli_fetch_array($result);
$views = $data['views'];

//해당 인덱스를 가진 댓글 행 불러오기
$comment_query = "SELECT * FROM comments WHERE content_number=$idx ORDER BY group_num,thread DESC";
$comment_result = mysqli_query($conn,$comment_query);


if(isset($_GET['idx'])){
    $title = $data['title'];
    $time = $data['time'];
    $contents = $data['contents'];
    $name = $data['user_id'];
    
    // 해당 경로로 접근 시 조회수 증가 후 조회수 컬럼에 내용 저장 
    $views = $views+1;
    $view_query = "UPDATE board SET views=$views WHERE idx=$idx";
    $view_result = mysqli_query($conn,$view_query);

    // 댓글 불러오기
    while($comment_data = mysqli_fetch_array($comment_result)){
        $comment_id = $comment_data['user_id'];
        $update_comment = '';
        $delete_comment = '';

        // 세션에 저장된 아이디=댓글의 아이디 같아면 수정 및 삭제 가능
        if($comment_id === $_SESSION['id']){
            $delete_comment = '<form action="../prc/delete_comment_prc.php" class="form" method="POST">
            <input type="hidden" name="content_number" value="'.$idx.'">
            <input type="hidden" name="idx" value="'.$comment_data['idx'].'">
            <button type="submit" class="" onclick="return submitForm()">삭제하기</button>
            </form>';
            $update_comment = '<form action="../prc/update_comment_prc.php" name="update_comment_form" class="form" method="PUT">
            <input type="hidden" id="comment'.$comment_data['idx'].'" name="comment" value="">
            <input type="hidden" name="idx" value="'.$comment_data['idx'].'">
            <input type="hidden" name="content_number" value="'.$idx.'">
            <button type="submit" class="" onclick="return updateComment('.$comment_data['idx'].')">수정하기</button>
            </form>';
        };
        
        // 로그인 되어있다면 댓글,답글 작성 버튼 표시 및 가능, 안되어있으면 버튼 숨기고 로그인 버튼 표시
        if($_SESSION['isLogin']=='true'){
            $comment_btn ='<form action="../prc/create_comment_prc.php" method="POST" name="comment_form">
            <div class="form-group">
                <h5>댓글</h5>
                <textarea style="height:20px"class="form-control" name="comment"  placeholder="댓글을 입력해주세요"></textarea>
            </div>
            <input type="hidden" class="form-control" name="content_number" value="'.$idx.'">
            <button type="submit" onclick="return submitComment()">댓글달기</button>
            </form>';
            $reply_post = '<form action="create.php" method="GET">
            <button type="submit" name="parent" value="'.$idx.'">답글달기</button></form>';
            $reply_comment = '<form action="../prc/create_comment_prc.php" class="form" name="" method="POST">
            <input type="hidden" id="re_comment'.$comment_data['idx'].'" name="comment" value="">
            <input type="hidden" name="parent" value="'.$comment_data['idx'].'">
            <input type="hidden" name="content_number" value="'.$idx.'">
            <button type="submit" class="" onclick="return replyComment('.$comment_data['idx'].')">댓글달기</button>
            </form>';
        } else {
            $comment_btn ='<form action="" method="POST" name="comment_form">
            <div class="form-group">
                <h5>댓글</h5>
                <textarea style="height:20px"class="form-control" name="comment"  placeholder="로그인 후 이용해주세요"></textarea>
            </div>
            <button type="" onclick="alert(\'로그인 후 이용해주세요\')">댓글달기</button>
            </form>';
            $reply_comment = '';
            $login = '<a href="../member/login.php">로그인</a>';
        };

        // 댓글 템플릿
        $comment_id = $comment_data['user_id'];
        $comment = $comment_data['comment'];
        $comment_time = $comment_data['time'];
        $comment_container = $comment_container.'<div class="container3">
        <p>'.$comment_id.'</p>
        <p>'.$comment.'</p>
        <p>'.$comment_time.$reply_comment.'</p>
        '.$update_comment.$delete_comment.'
        </div>';
        };
        
        // 댓글 데이터 없을시 댓글달기,답글달기 버튼 
        if($_SESSION['isLogin']=='true'){
            $comment_btn ='<form action="../prc/create_comment_prc.php" method="POST" name="comment_form">
            <div class="form-group">
                <h5>댓글</h5>
                <textarea style="height:20px"class="form-control" name="comment"  placeholder="댓글을 입력해주세요"></textarea>
            </div>
            <input type="hidden" class="form-control" name="content_number" value="'.$idx.'">
            <button type="submit" onclick="return submitComment()">댓글달기</button>
            </form>';
            $reply_post = '<form action="create.php" method="GET">
            <button type="submit" name="parent" value="'.$idx.'">답글달기</button></form>';
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

        // 해당 글의 아이디와 세션에 저장된 아이디 같다면 글 삭제 및 수정 버튼 표시
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
// 삭제 확인 경고창
  function submitForm(){
    var check = confirm('정말 삭제하시겠습니까?');
 if(check){
     return true;
 } else{
     return false;
 }
 document.login_form.submit(); 
};

// 빈칸으로 제출시 알림
function submitComment(){
 if(!document.comment_form.comment.value){
     alert('댓글을 입력해주세요');
     return false;
 } 
 document.comment_form.submit(); 
};

function updateComment(a){
    var comment = prompt('댓글을 입력하세요');
    if(!comment){
        return false;
    }else{
    // document.update_comment_form.comment.value = comment;
    document.getElementById(`comment${a}`).value = comment;
    };
};

function replyComment(a){
    var comment = prompt('댓글을 입력하세요');
    if(!comment){
        return false;
    }else{
    document.getElementById(`re_comment${a}`).value = comment;
    };
};
</script>

<h3>자유게시판</h3>
<div class="container">
    <h3><?=$title?></h3><br>
    <?=$name?> | <?=$time?>
</div>
<div class="container2">
    <p><?=$contents?></p> 
</div>
<?=$reply_post?>
<?=$comment_container?>
<div class="container">
    <?=$comment_btn?>
</div>
<?=$delete_btn?>
<?=$update_btn?>
<a href="../index.php">돌아가기</a>
<?=$login?>
<?php require_once '../lib/footer.php';?>


