<?php
include 'lib.php';
require_once 'header.php';
?>
    <div class="login-form">
        <form action="signup_prc.php" method="POST">
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
                <button type="submit" class="btn btn-primary btn-block">회원가입</button>
            </div>
        </form>
        <p class="text-center"><a href="index.php">로그인</a></p>
    </div>
<?php
require_once 'footer.php';
?>
                            		