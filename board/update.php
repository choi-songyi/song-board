<?php include '../lib/lib.php';
require_once '../lib/header.php';

$idx = $_POST['idx'];
$update_query = "SELECT * FROM board WHERE idx=$idx";
$result = mysqli_query($conn,$update_query);

if($data = mysqli_fetch_array($result)){
    $title = $data['title'];
    $contents = $data['contents'];
}
?>
<script>
  function submitForm(){
 if(!document.update_form.title.value){
     alert("제목을 입력하세요.");
     return false;
 }
 if(!document.update_form.contents.value){
     alert("내용을 입력하세요.");
     return false;
 }
 document.update_form.submit(); 
}
</script>
<h1 class="h2">수정하기</h1>
<div class="container">
    <form action="../prc/update_prc.php" method="PUT" name="update_form">
        <div class="form-group">
            <h4>제목</h4>
            <input type="text" class="form-control" name="title" value="<?php echo $title;?>">
        </div>
        <div class="form-group">
            <h4>내용</h4>
            <textarea style="height:300px"class="form-control" name="contents"><?php echo $contents;?></textarea>
        </div>
        <input type="hidden" class="form-control" name="idx" value="<?php echo $idx;?>">
        <button type="submit" onclick="return submitForm()">수정하기</button>
    </form>
    <a href="../index.php">돌아가기</a>
</div>
<?php require_once '../lib/footer.php';?>