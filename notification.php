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
                <a href="<?php echo url_for($user->username); ?>" role="link" class="userImageContainer" aria-label="<?php  echo $user->firstName.' '.$user->lastName;?>">
                    <img src="<?php echo url_for($user->profileImage); ?>" alt="<?php  echo $user->firstName.' '.$user->lastName;?>" class="">
                </a>
                <form class="textareaContainer">
                    <textarea name="" id="postTextarea" placeholder="What's happening?" aria-label="What's happening?"  ></textarea>
                    <div class="hash-box-wrapper">
                        <div class="hash-box" role="listbox" aria-multiselectable="false">
                            <ul class="">
                            </ul>
                        </div>
                    </div>
                    <div class="buttonsContainer">
                        <input type="submit" id="submitPostButton" disabled="true" role="button" value="POST" class="">
                        <div class="w-count-wrapper">
                            <div id="count">200</div>
                            <div class="vertical-pipe"></div>
                        </div>
                    </div>
                </form>
            </div>
            <section aria-label="Timeline:Your Home Timeline" class="postContainer">
                <?php $loadFromPosts->posts($user_id,10)?>
            </section>
        </section>
        <aside class="" role="complementary"></aside>
    </main>
</section>

<script src="<?php echo url_for('frontend\assets\js\common.js'); ?>"></script>
<script src="<?php echo url_for('frontend\assets\js\fetchPosts.js'); ?>"></script>
<script src="<?php echo url_for('frontend\assets\js\hashtag.js'); ?>"></script>
<script src="<?php echo url_for('frontend\assets\js\likePost.js'); ?>"></script>