<!-- <?php include 'lib.php';
require_once 'header.php';
          
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = mysql_escape_string($_GET['email']); // Set email variable
    $hash = mysql_escape_string($_GET['hash']); // Set hash variable
                 

    $verify_query = "SELECT email, hash, active FROM member WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
    $result = mysqli_query($conn,$verify_query);
    $data  = mysql_fetch_array($result);
                 
    if($data){
        $update_query = "UPDATE member SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'"
        echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
    }else{
        echo '<p>The url is either invalid or you already have activated your account.</p>';
    }
                 
}else{
    echo '<p>Invalid approach, please use the link that has been send to your email.</p>';
}

require_once 'footer.php';?> -->
