<?php
Include_once 'backend\initialize.php'; 
$user_id = $_SESSION['userLoggedIn'];
$status = $verify->getVerifyStatus("status",$user_id);


//check if user is logged in
if(isset($_SESSION['userLoggedIn']) && $status->status === "1"){
    $user_id = $_SESSION['userLoggedIn'];
    
}else if(Login::isLoggedIn()){
    $user_id = Login::isLoggedIn();
}else{
    redirect_to(url_for("index"));
}

$user = $loadFromUser->userData($user_id);

$pageTitle="Home | WeLink";

?>
<div class="u-p-id" data-uid="<?php echo $user_id ?>"></div>
<section class="wrapper">
    <?php require_once 'backend\shared\nav_header.php'; ?>
    <main role="main" class="mainSectionContainer">
        <section class="mainSectionContainer">
            <div class="header-top">
                <h4>Home</h4>
                <img src="<?php echo url_for("frontend\assets\images\star.svg"); ?>" width="40px" height="40px" alt="" class="">
            </div>
            <div class="header-post">
            <div class="userImageContainer" aria-label="<?php  echo $user->firstName.' '.$user->lastName;?>">
                <img src="<?php echo url_for($user->profileImage); ?>" alt="<?php  echo $user->firstName.' '.$user->lastName;?>" class="">
            </div>
            <form class="textareaContainer">
                <textarea name="" id="postTextarea" placeholder="What's happening?" aria-label="What's happening?" autofocus ></textarea>
                <div class="buttonsContainer">
                    <input type="submit" id="submitPostButton" disabled="true" role="button" value="POST" class="">
                </div>
            </form>
            </div>
        </section>
        <aside class="" role="complementary"></aside>
    </main>
</section>

<script src="<?php echo url_for('frontend\assets\js\common.js'); ?>"></script>