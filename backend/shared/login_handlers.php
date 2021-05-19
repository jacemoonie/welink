<?php 
if(isset($_SESSION['userLoggedIn'])){
    redirect_to(url_for("home"));
}else if(Login::isLoggedIn()){
    redirect_to(url_for("home"));
}

if(is_post_request()){
    if(isset($_POST['username']) && !empty($_POST['username'])){
         $username=FormSanitizer::formSanitizerName($_POST['username']);
         $pass=FormSanitizer::formSanitizerString($_POST['password']);

        $wasSuccessful = $account->login($username,$pass);
        if($wasSuccessful){
            $user_id = $wasSuccessful;
           $_SESSION['userLoggedIn'] = $wasSuccessful;
           if(isset($_POST['remember'])){
            $tsrong = true;
            $token = bin2hex(openssl_random_pseudo_bytes(64,$tsrong));
            $loadFromUser->create("token",["user_id"=> $user_id, "token" => sha1($token)]);
            setcookie("FBID", $token, time() + 60*60*24*7, "/", NULL, NULL, true);
           }

           redirect_to(url_for("home"));

        }
    }

}

?>