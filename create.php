<?php include 'lib.php';
require_once 'header.php';
?>
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
    <form action="create_prc.php" method="POST" name="create_form">
        <div class="form-group">
            <h4>제목</h4>
            <input type="text" class="form-control" name="title" placeholder="제목을 입력해주세요">
        </div>
        <div class="form-group">
            <h4>내용</h4>
            <textarea style="height:300px"class="form-control" name="contents"  placeholder="내용을 입력해주세요"></textarea>
        </div>
        <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['id'];?>">
        <button type="submit" onclick="return submitForm()">작성하기</button>
    </form>
    <a href="index.php">돌아가기</a>
</div>
<?php require_once 'footer.php';?>