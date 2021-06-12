<?php include '../lib/lib.php';
require_once '../lib/header.php';
?>
<script>
  function submitForm(){
 if(!document.login_form.user_id.value){
     alert("아이디를 입력하세요.");
     return false;
 }
 if(!document.login_form.password.value){
     alert("비밀번호를 입력하세요.");
     return false;
 }
 document.login_form.submit(); 
}
</script>
<div class="login-form">
    <form action="../prc/login_prc.php" method="POST" name="login_form">
        <h2 class="text-center">로그인</h2>       
        <div class="form-group">
            <input type="text" name="user_id" class="form-control" placeholder="아이디">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="비밀번호">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" onclick="return submitForm()">로그인</button>
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox">아이디 저장</label>
            <a href="reset_password.php" class="pull-right">비밀번호 분실</a>
        </div>        
    </form>
    <p class="text-center"><a href="signup.php">회원가입</a></p>
</div>
<?php require_once '../lib/footer.php';?>
