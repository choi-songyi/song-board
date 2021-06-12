<?php
include '../lib/lib.php';
require_once '../lib/header.php';
?>
<script>
  function submitForm(){
 if(!document.signup_form.user_id.value){
     alert("아이디를 입력하세요.");
     return false;
 }
 if(!document.signup_form.password.value){
     alert("비밀번호를 입력하세요.");
     return false;
 }
 if(!document.signup_form.email.value){
     alert("이메일을 입력하세요.");
     return false;
 }
 if(!document.signup_form.user_name.value){
     alert("이름을 입력하세요.");
     return false;
 }
 document.signup_form.submit(); 
}
</script>
<div class="login-form">
    <form action="../prc/signup_prc.php" method="POST" name="signup_form">
        <h2 class="text-center">회원가입</h2>       
        <div class="form-group">
            <input type="text" name="user_id" class="form-control" placeholder="아이디">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="비밀번호">
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="이메일">
        </div>
        <div class="form-group">
            <input type="text" name="user_name" class="form-control" placeholder="이름">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" onclick="return submitForm()">회원가입</button>
        </div>
    </form>
    <p class="text-center"><a href="login.php">로그인</a></p>
</div>
<?php
require_once '../lib/footer.php';
?>
                            		