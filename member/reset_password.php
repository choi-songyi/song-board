<?php
include '../lib/lib.php';
require_once '../lib/header.php';
?>
    <div class="login-form">
        <form action="../prc/reset_password_prc.php" method="POST">
            <h2 class="text-center">비밀번호 분실</h2>       
            <div class="form-group">
                <input type="text" name="user_id" class="form-control" placeholder="아이디를 입력하세요">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="이메일을 입력하세요">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">확인</button>
            </div>
        </form>
        <p class="text-center"><a href="../member/login.php">로그인</a></p>
    </div>
<?php
require_once '../lib/footer.php';
?>
