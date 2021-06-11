<?php include 'lib.php';
require_once 'header.php';

$board_query = "SELECT * FROM board ORDER BY idx DESC";
$result = mysqli_query($conn,$board_query);

$list = '';
$logout_btn = '';
$login_btn = '';
$write_btn = '';
$id = $_SESSION['id'];
$greeting = '로그인 후 이용해주세요';


while($data = mysqli_fetch_array($result)){
    $idx = $data['idx'];
    $title = $data['title'];
    $name = $data['user_id'];
    $time = $data['time'];
    
    $list = $list.'<tr>
    <th scope="row">'.$idx.'</th>
    <td><a href="detail.php?idx='.$idx.'">'.$title.'</a></td>
    <td>'.$name.'</td>
    <td>'.$time.'</td>
    <td>@mdo</td>
    <td>@mdo</td>
    </tr>';
}

if($_SESSION['isLogin']==='true'){
    $greeting = $id.'님 안녕하세요';
    $logout_btn = '<form action="logout_prc.php" method="POST">
    <button type="submit" class="custom">로그아웃</button>
</form>' ;
    $write_btn = '<form action="create.php" method="POST">
    <button type="submit" class="custom">글쓰기</button>
</form>';
} else if($isLogin = 'false'){
    $greeting = '로그인 후 이용해주세요';
    $login_btn = '<form action="login.php" method="POST">
    <button type="submit" class="custom">로그인</button>
</form>';
}
?>

<h3><?php echo $greeting;?></h3>
<div class="container">
    <h1 class="h2">자유게시판</h1>
    <?php echo $write_btn;?>
    <br>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">번호</th>
        <th scope="col">제목</th>
        <th scope="col">작성자</th>
        <th scope="col">날짜</th>
        <th scope="col">조회수</th>
        <th scope="col">댓글수</th>
        </tr>
    </thead>
    <tbody>
       <?= $list;?>
    </tbody>
    </table>
    <?php echo $logout_btn;?>
    <?php echo $login_btn;?>
</div>
<?php require_once 'footer.php';?>

