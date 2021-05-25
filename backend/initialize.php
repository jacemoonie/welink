<?php
ob_start();

date_default_timezone_set('Asia/Kuala_Lumpur');

$script_tz = date_default_timezone_get();

define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'\backend\config.php'); 
include(__ROOT__.'\backend\classes\PHPMailer.php'); 
include(__ROOT__.'\backend\classes\Exception.php'); 
include(__ROOT__.'\backend\classes\SMTP.php'); 

session_start();
//include classes
//include 'backend\classes\Database.php';
//Include 'backend\classes\FormSanitizer.php'; 

spl_autoload_register(function($class){
    require_once(__ROOT__."/backend/classes/$class.php"); 
});



$account= new Account;
$loadFromUser = new User;
$verify = new Verify;
$loadFromPosts = new Posts;
$postsControl = new PostsControls;
$loadFromFriend = new Friend;


include(__ROOT__.'\backend\shared\functions.php'); 
include(__ROOT__.'\backend\shared\header.php');



