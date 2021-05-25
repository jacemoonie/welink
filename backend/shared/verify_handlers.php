<?php
$user_id=$_SESSION['userLoggedIn'];

// $status = $verify->getVerifyStatus("status",$user_id);

// if(Login::isLoggedIn()){
//     redirect_to(url_for('home'));
// }else if(isset($_SESSION['userLoggedIn']) && $status->status=='1'){
//     redirect_to(url_for('home'));
// }
  

$errors=array();
if(isset($_SESSION['userLoggedIn'])){
    $user_id =(int)($_SESSION['userLoggedIn']);
    $user = $loadFromUser->userData($user_id);
    
    // $loadFromUser->create("users",['user_id'=>1,"profileEdit"=>0]);
    $link = $verify->generateLink(); 
    $message="{$user->firstName}, Your account has been created, Please visit this link to verify your email <a href='http://localhost/welink/verification/$link'>Verify link</a>";
    $subject="[WELINK] Please verify your account";
    $verify->sendToMail($user->email,$message,$subject);
    $loadFromUser->create("verification",["user_id"=>$user_id,"code"=>$link]);
}else{
    redirect_to(url_for("index"));
}

if(is_get_request()){
    $user_id =(int)($_SESSION['userLoggedIn']);
    if(isset($_GET['verify'])){
      $code = FormSanitizer::formSanitizerString($_GET['verify']); 
      $verifyCode = $verify->verifyCode("*",$code);
      if($verifyCode){
          if(date('Y-m-d',strtotime($verifyCode->createdAt)) < date('Y-m-d')){
              $errors['verify'] = "Your verification link has been expired.";
          }else{
              $loadFromUser->update("verification",$user_id,array("code"=>$code,"status"=>1));
              var_dump($loadFromUser);
              if(isset($_SESSION['rememberMe'])){
                  $tsrong = true;
                  $token = bin2hex(openssl_random_pseudo_bytes(64,$tsrong));
                  $loadFromUser->create("token",["user_id"=> $user_id, "token" => sha1($token)]);
                  setcookie("FBID", $token, time() + 60*60*24*7, "/", NULL, NULL, true);
              }
              redirect_to(url_for("home"));
          }
      }else{
        $errors['verify'] = "Invalid verification link";  
      }
    }
}



?>