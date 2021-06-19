<?php include '../lib/lib.php';
require_once '../lib/header.php';

// 부모 인덱스 있으면 스레드 확인, 없으면 0으로 넘김
if(isset($_GET['parent'])){
    $parent = $_GET['parent'];
    $check_thread = "SELECT * FROM board WHERE group_num='$parent'";
    $result = mysqli_query($conn,$check_thread);
    $data = mysqli_num_rows($result);
   
    if($data == 100){
        echo'<h1>답글 최대 갯수를 초과하여 답글을 작성할 수 없습니다.</h1>';
        $submit_btn = '';
    } else{
        $submit_btn = '<button type="submit" onclick="return submitForm()">작성하기</button>';
    }
} else{
    $parent = 0;
    $submit_btn = '<button type="submit" onclick="return submitForm()">작성하기</button>';
}
?>

<!-- 빈칸으로 제출시 alert -->
<script>
  function submitForm(){
 if(!document.create_form.title.value){
     alert("제목을 입력하세요.");
     return false;
 }
 if(!document.create_form.contents.value){
     alert("내용을 입력하세요.");
     return false;
 }
 document.create_form.submit(); 
}
</script>
<h1 class="h2">작성하기</h1>
<div class="container">
    <form action="../prc/create_prc.php" method="POST" name="create_form">
        <div class="form-group">
            <h4>제목</h4>
            <input type="text" class="form-control" name="title" placeholder="제목을 입력해주세요">
        </div>
        <div class="form-group">
            <h4>내용</h4>
            <textarea style="height:300px"class="form-control" name="contents"  placeholder="내용을 입력해주세요"></textarea>
        </div>
        <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['id'];?>">
        <input type="hidden" class="form-control" name="parent" value="<?php echo $parent;?>">
        <?php echo $submit_btn;?>
    </form>
    <a href="../index.php">돌아가기</a>
</div>
<?php require_once '../lib/footer.php';?>