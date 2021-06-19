<?php 

include '../lib/lib.php';
require_once '../lib/header.php';

$category = $_GET['category'];
$search = $_GET['search'];

$search_query = "SELECT * FROM board WHERE $category like '%$search%' ORDER BY idx DESC";
$result = mysqli_query($conn,$search_query);

$list = '';
$logout_btn = '';
$login_btn = '';
$write_btn = '';

// 검색시에는 글 원래 인덱스 출력
while($data = mysqli_fetch_array($result)){
    $idx = $data['idx'];
    $title = $data['title'];
    $name = $data['user_id'];
    $time = $data['time'];
    
    $list = $list.'<tr>
    <th scope="row">'.$idx.'</th>
    <td><a href="../board/detail.php?idx='.$idx.'">'.$title.'</a></td>
    <td>'.$name.'</td>
    <td>'.$time.'</td>
    <td>@mdo</td>
    <td>@mdo</td>
    </tr>';

}

// 로그인 되어있으면 로그아웃, 글쓰기 버튼 표시
if($_SESSION['isLogin']==='true'){
    $logout_btn = '<form action="../prc/logout_prc.php" method="POST">
    <button type="submit" class="custom">로그아웃</button>
</form>' ;
    $write_btn = '<form action="create.php" method="POST">
    <button type="submit" class="custom">글쓰기</button>
</form>';
} else if($isLogin = 'false'){
    $login_btn = '<a href = "../member/login.php">로그인</a>';
}
?>

<div class="container">
    <h1 class="h2">'<?php echo $search;?>' 검색결과</h1>
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
    <form action="../index.php" method="POST">
    <button type="submit" class="custom">돌아가기</button>
</form>
</div>
<div class="search_box">
    <form action="search.php" method="get">
      <select name="category">
        <option value="title">제목</option>
        <option value="user_id">작성자</option>
        <option value="contents">내용</option>
      </select>
      <input type="text" name="search" size="40"/> 
      <button type="submit">검색</button>
    </form>
</div>
<?php require_once '../lib/footer.php';?>
