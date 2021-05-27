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

if(is_get_request()){
    if(isset($_GET['username']) && !empty($_GET['username'])){
      $username = FormSanitizer::formSanitizerString($_GET['username']);
      $profileID = $loadFromUser->userIdByUsername($username);
      if(!$profileID){
          redirect_to(url_for("home")); 
      }else{
          $profileId = $profileID;
          $profileData = $loadFromUser->userData($profileId);
      }
    }else{
        $profileId = $user_id;
        $profileData = $loadFromUser->userData($profileId);
    }
}
$user = $loadFromUser->userData($user_id);

$date_joined = strtotime($profileData->signUpDate);


$pageTitle=$profileData->firstName.' '.$profileData->lastName.'(@'.$profileData->username.') | WeLink';

?>
<div class="u-p-id" data-uid="<?php echo $user_id ?>" data-pid ="<?php echo $profileData->user_id; ?>" ></div>
<section class="wrapper">
    <?php require_once 'backend\shared\nav_header.php'; ?>
    <main role="main" class="mainSectionContainer">
        <section class="mainSectionContainer">
            <div class="header-top">
                <div class="go-back-arrow" id="go-back-home" aria-label="Back" role="button" data-focusable="true" tabIndex="0">
                    <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
                </div>
                <div class="header-top-pro">
                    <h4><?php echo $profileData->firstName.' '.$profileData->lastName; ?></h4>
                    <?php if(!empty($loadFromPosts->PostCounts($profileId))){ ?>
                    <div class="tweet-no"><?php echo $loadFromPosts->PostCounts($profileId); ?> Posts</div>
                    <?php } ?>
                </div>
            </div>
            <?php require_once 'backend\shared\profile_header.php'; ?>
            <div class="tabsContainer">
                <?php echo $loadFromPosts->createTab('Posts',url_for($profileData->username),true);?>
                <?php echo $loadFromPosts->createTab('Replies',url_for($profileData->username,'/replies'),false);?>
            </div>

            <section aria-label="Timeline:Your Profile Timeline" class="profilePostContainer">
                <?php $loadFromPosts->profilePost($profileId,10)?>
            </section>
            <div class="reply-wrapper">
            
            </div>
            <?php require_once 'backend\shared\previewContainer.php'; ?>
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
<script src="<?php echo url_for('frontend\assets\js\profile.js'); ?>"></script>