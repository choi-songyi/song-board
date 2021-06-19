
<?php include './lib/lib.php';

if($_GET['page']){
    $page = $_GET['page'];
} else{
    $page = 1;
};

// 한 페이지 내 글 개수
$page_num = 10; 

// 전체 글 개수
$count_result = mysqli_query($conn,"SELECT * FROM board");
$count = mysqli_num_rows($count_result);

// 데이터 불러오는 시작점
$start = ($page-1)*$page_num;

// 시작점부터 한페이지 내 글 개수 만큼 데이터 불러옴
$board_query = "SELECT * FROM board ORDER BY group_num DESC, group_order ASC LIMIT $start,$page_num";
$result = mysqli_query($conn,$board_query);

// 페이지 개수
$pages = ceil($count/$page_num);

$list = '';
$logout_btn = '';
$login_btn = '';
$write_btn = '';
$greeting = '로그인 후 이용해주세요';
$level_msg = '';
$i = 1;
while($data = mysqli_fetch_array($result)){
    $idx = $data['idx'];
    $title = $data['title'];
    $name = $data['user_id'];
    $time = $data['time'];
    $views = $data['views'];


    $comment_query = "SELECT * FROM comments WHERE content_number = $idx";
    $comment_result = mysqli_query($conn,$comment_query);
    if($comment_data = mysqli_num_rows($comment_result)){
        $comment =$comment_data;
    } else{ 
        $comment = 0;
    }

    $list = $list.'<tr>
    <th style="width:10px">'.$i.'</th>
    <td><a href="./board/detail.php?idx='.$idx.'">'.$title.'</a></br></td>
    <td>'.$name.'</td>
    <td>'.$time.'</td>
    <td>'.$views.'</td>
    <td>'.$comment.'</td>
    </tr>';

    $i = $i+1;
}

if($_SESSION['isLogin']==='true'){
    $id = $_SESSION['id'];
    $greeting = $id.'님 안녕하세요';
    $level_query = "SELECT * FROM member WHERE user_id='$id'";
    $level_result = mysqli_query($conn,$level_query);
    $level_data = mysqli_fetch_array($level_result);
    $level = $level_data['level'];
    $level_msg = '회원님의 등급은 '.$level.'입니다';
    $logout_btn = '<form action="./prc/logout_prc.php" method="POST">
    <button type="submit" class="custom">로그아웃</button>
</form>' ;
    $write_btn = '<form action="./board/create.php" method="POST">
    <button type="submit" class="custom">글쓰기</button>
</form>';
} else if($isLogin = 'false'){
    $greeting = '로그인 후 이용해주세요';
    $login_btn = '<a href="./member/login.php">로그인</a>';
};
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Project 1</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="main.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body>
<h3><?php echo $greeting;?></h3>
<h4><?php echo $level_msg ?></h4>
<a href="./member/level.html">회원 등급 기준 보러가기</a>
<div class="container">
    <h1 class="h2">자유게시판</h1>
    <?php echo $write_btn;?>
    <?php echo $logout_btn;?>
    <?php echo $login_btn;?>
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
</div>
<div>
    <?php
    for($i=0; $i<$pages; $i++){
        echo '<a href='.$_SERVER['PHP_SELF'].'?page='.($i+1).'>'.($i+1).'</a>';
    };
    ?>
</div>
<div class="search_box">
    <form action="./board/search.php" method="get">
      <select name="category">
        <option value="title">제목</option>
        <option value="user_id">작성자</option>
        <option value="contents">내용</option>
      </select>
      <input type="text" name="search" size="40"/> 
      <button type="submit">검색</button>
    </form>
    </div>
<?php require_once './lib/footer.php';?>

