<?php
ob_start();

date_default_timezone_set('Asia/Kuala_Lumpur');

$script_tz = date_default_timezone_get();

require_once "backend\config.php";
include "backend\classes\PHPMailer.php";
include "backend\classes\Exception.php";
include "backend\classes\SMTP.php";

session_start();
//include classes
//include 'backend\classes\Database.php';
//Include 'backend\classes\FormSanitizer.php'; 

spl_autoload_register(function($class){
    require_once "classes/$class.php";
});



$account= new Account;
$loadFromUser = new User;
$verify = new Verify;

include 'backend\shared\functions.php';
include 'backend\shared\header.php';



