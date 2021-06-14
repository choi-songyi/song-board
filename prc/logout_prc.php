<?php
include '../lib/lib.php';

$_SESSION['isLogin'] = 'false';
$_SESSION['id'] = '';
session_destroy();
header('location:../index.php');


?>