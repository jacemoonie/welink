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
            <div class="d-wrapper-container">
                <div class="d-wrapper">
                    <div class="d-content" id="del-content">
                        <div class="d-image">
                            <svg viewBox="0 0 24 24" class="del-icon"><g><path d="M20.746 5.236h-3.75V4.25c0-1.24-1.01-2.25-2.25-2.25h-5.5c-1.24 0-2.25 1.01-2.25 2.25v.986h-3.75c-.414 0-.75.336-.75.75s.336.75.75.75h.368l1.583 13.262c.216 1.193 1.31 2.027 2.658 2.027h8.282c1.35 0 2.442-.834 2.664-2.072l1.577-13.217h.368c.414 0 .75-.336.75-.75s-.335-.75-.75-.75zM8.496 4.25c0-.413.337-.75.75-.75h5.5c.413 0 .75.337.75.75v.986h-7V4.25zm8.822 15.48c-.1.55-.664.795-1.18.795H7.854c-.517 0-1.083-.246-1.175-.75L5.126 6.735h13.74L17.32 19.732z"></path><path d="M10 17.75c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75zm4 0c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75z"></path></g></svg>
                        </div>
                        <span class="d-text">
                            Delete
                        </span>
                    </div>
                </div>
            </div>
            <div class="del-post-wrapper-container">
                <div class="del-post-wrapper">
                    <div class="del-post-content">
                    <h2 class="del-post-content-header">Delete post?</h2>
                    <p>This can't be undone and the post will be deleted.
                    <div class="del-btn-wrapper">
                        <button class="del-btn" id="cancel" type="button">Cancel</button>
                        <button class="del-btn" id="delete-post-btn" type="button">Delete</button>
                    </div>
                    </div>
                </div>
            </div>
        </section>
        <?php require_once 'backend\shared\aside-section.php'; ?>
    </main>
</section>

<script src="<?php echo url_for('frontend\assets\js\common.js'); ?>"></script>
<script src="<?php echo url_for('frontend\assets\js\fetchPosts.js'); ?>"></script>
<script src="<?php echo url_for('frontend\assets\js\hashtag.js'); ?>"></script>
<script src="<?php echo url_for('frontend\assets\js\likePost.js'); ?>"></script>
<script src="<?php echo url_for('frontend\assets\js\delete.js'); ?>"></script>