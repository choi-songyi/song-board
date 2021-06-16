<?php
include '../lib/lib.php';

$title = mysqli_real_escape_string($conn,$_POST['title']);
$contents = mysqli_real_escape_string($conn,nl2br($_POST['contents']));
$id = $_SESSION['id'];
$parent = $_POST['parent'];

if(!$parent==0){
    $query = "SELECT * FROM board WHERE idx ='$parent'";
    $result = mysqli_query($conn,$query);
    $data = mysqli_fetch_array($result);
    $re_title = '└'.$data['title'].'의 답글 : '.$title;
    if($data['group_num']==0){ 
        $group_num = $data['idx'];
        $parent = $data['idx'];
    } else{
        $group_num = $data['group_num'];
    }

    $depth = $data['depth'] +1;
    $thread_query = "SELECT * FROM board WHERE group_num ='$group_num'";
    $thread_result = mysqli_query($conn,$thread_query);
    $thread_data = mysqli_num_rows($thread_result);
    $thread =99-$thread_data; 
    $group_order = 1+$thread_data;
    $create_query = "INSERT INTO board (title,contents,time,user_id,views,group_num,group_order,depth,thread,parent) VALUES('$re_title','$contents',NOW(),'$id','0','$group_num','$group_order','$depth','$thread','$parent')";
} else if($parent==0){
    $create_query = "INSERT INTO board (title,contents,time,user_id,views,group_num,depth,thread,parent) VALUES('$title','$contents',NOW(),'$id','0','0','0','100','0')";
};

$result = mysqli_query($conn,$create_query);

if($result){
    header('location:create_prc2.php');
} else{
    require_once '../lib/header.php';
    echo '<p class="text-center">저장하는 과정에서 문제가 발생했습니다. <br><a href=../board/create.php>다시 작성해주세요</a></p>';
    require_once '../lib/footer.php';
}

?>
