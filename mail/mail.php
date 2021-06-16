<?php


include '../lib/lib.php';

$id = mysqli_real_escape_string($conn,$_POST['user_id']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$name = mysqli_real_escape_string($conn,$_POST['user_name']);

$signup_query = "INSERT INTO member (user_id,password,email,user_name,active,level) VALUES('$id',password('$password'),'$email','$name','1','0')";
$result = mysqli_query($conn,$signup_query);

if($result){
   echo '인증 메일이 발송 되었습니다. 이메일 인증을 완료해주세요';
} else{
    echo '<p class="text-center"><a href=../member/signup.php>중복된 아이디 또는 이메일 입니다</a></p>';
    // echo mysqli_error($conn);
}

// # Include the Autoloader (see "Libraries" for install instructions)
// require 'vendor/autoload.php';
// use Mailgun\Mailgun;
// # Instantiate the client.
// $mgClient = new Mailgun('8ec06383d9378631e7579fe1bec4b4f1-24e2ac64-0a8443dd');
// $domain = "sandbox8c489490264b4f948c685976655c191f.mailgun.org";
// # Make the call to the client.
// $result = $mgClient->sendMessage($domain, array(
// 	'from'	=> 'Excited User <mailgun@sandbox8c489490264b4f948c685976655c191f.mailgun.org>',
// 	'to'	=> 'Baz <YOU@sandbox8c489490264b4f948c685976655c191f.mailgun.org>',
// 	'subject' => 'Hello',
// 	'text'	=> 'Testing some Mailgun awesomness!'
// ));



//Import PHPMailer classes into the global namespace


include 'PHPMailer.php';
include 'SMTP.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
$mail->Host = 'smtp.naver.com';

//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;


//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = 'ssl';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'thddlwlsdl';

//Password to use for SMTP authentication
$mail->Password = '6CYTSGC3Z52W';

$mail->CharSet = 'UTF-8';

//Set who the message is to be sent from
$mail->setFrom('thddlwlsdl@naver.com', 'SongBoard');

//Set an alternative reply-to address
$mail->addReplyTo('thddlwlsdl@naver.com', 'SongBoard');

//Set who the message is to be sent to
$mail->addAddress($email, $name);

//Set the subject line
$mail->Subject = '회원가입 인증 메일입니다.';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML('<p>회원가입을 환영합니다!<br></p>
<p>아래 링크를 클릭해주세요<br></p>
<a href="https://project-songyi.herokuapp.com/prc/signup_prc.php?id='.$id.'">https://project-songyi.herokuapp.com/prc/signup_prc.php?id='.$id.'</a>');

//Replace the plain text body with one created manually
$mail->AltBody = '회원가입 인증 메일입니다';

//Attach an image file
$mail->addAttachment('');

//send the message, check for errors
// if (!$mail->send()) {
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'Message sent!';
//     //Section 2: IMAP
//     //Uncomment these to save your message in the 'Sent Mail' folder.
//     #if (save_mail($mail)) {
//     #    echo "Message saved!";
//     #}
// }

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}


