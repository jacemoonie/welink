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
            <section class="profileHeaderContainer">
                <div class="coverPhotoContainer">
                    <img src="<?php echo url_for($profileData->profileCover);?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName; ?>" class="cover-photo-user-me" aria-label="Profile Cover Image">
                    <div class="userImageContainer">
                        <img src="<?php echo url_for($profileData->profileImage);?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName; ?>" class="profile-pic-me" aria-label="Profile Pic Image">
                    </div>
                </div>
                <div class="profileButtonContainer">
                    <?php echo $loadFromFriend->profileBtn($profileId,$user_id); ?>
                    <!-- <button class="edit-profile-btn" role="button">Set up Profile</button> -->
                </div>
                <div class="userDetailsContainer">
                    <span class="displayName"><?php echo $profileData->firstName.' '.$profileData->lastName; ?></span>
                    <span class="username">@<?php echo $profileData->username;?></span>
                    <span class="description">
                        <svg viewBox="0 0 24 24" class=""><g><path d="M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z"></path><circle cx="7.032" cy="8.75" r="1.285"></circle><circle cx="7.032" cy="13.156" r="1.285"></circle><circle cx="16.968" cy="8.75" r="1.285"></circle><circle cx="16.968" cy="13.156" r="1.285"></circle><circle cx="12" cy="8.75" r="1.285"></circle><circle cx="12" cy="13.156" r="1.285"></circle><circle cx="7.032" cy="17.486" r="1.285"></circle><circle cx="12" cy="17.486" r="1.285"></circle></g></svg>
                        <span class="join">
                            Joined
                        </span>
                        <span class="description__date"><?php echo date("F Y",$date_joined); ?></span>
                    </span>
                    <div class="followersContainer">
                        <a href="<?php echo url_for($profileData->username.'/following'); ?>" class="">
                           <span class="value count-following">0</span> 
                           <span class="">Friends</span>
                        </a>
                    </div>
                </div>
            </section>
            <div class="tabsContainer">
                <?php echo $loadFromPosts->createTab('Posts',url_for($profileData->username),true);?>
                <?php echo $loadFromPosts->createTab('Replies',url_for($profileData->username,'/replies'),false);?>
            </div>

            <section aria-label="Timeline:Your Profile Timeline" class="profilePostContainer">
                <?php $loadFromPosts->profilePost($profileId,10)?>
            </section>
            <div class="reply-wrapper">

            </div>
            <div class="modal-pic" id="modal-pic" style="display:none;">
                <div class="artdeco-modal-pic" role="dialog" aria-labelledby="profile-topcard-background-image-header">
                    <div class="art-pic-step" aria-modal="true" style="display:none;">
                        <div class="header__topcard">
                            <div class="a-modal-site-log-wrapper">
                                <img width="40px" height="40px" src="frontend\assets\favicon\icons8-link-100.png" alt="" class="">
                            </div>
                            <div class="p-btn" id="a-modal-skip">
                                Skip for now
                            </div>
                        </div>
                        <div class="modal-body__topcard">
                            <h1 class="">Pick a profile picture</h1>
                            <p class="">Have a favourite selfie? Upload it now.</p>
                            <div class="modal-body__topcard-container">
                                <div class="edit-profile__topcard-wrapper">
                                    <img  src="<?php echo url_for($profileData->profileImage);?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName;?>" class="">
                                </div>
                                <div class="topcard-btn-icon">
                                    <label for="topcard-filePhoto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" id="camera-small" data-supported-dps="48x48">
                                            <path d="M46 8H30.52l-2.59-3.27a2.33 2.33 0 00-1.7-.73h-4.46a2.33 2.33 0 00-1.7.73L17 8H2a2.42 2.42 0 00-2 2v30a2.42 2.42 0 002 2h44a2.42 2.42 0 002-2V10a2.42 2.42 0 00-2-2z" fill="#56697a"/>
                                            <path fill="#788fa5" d="M0 10h48v30H0z"/>
                                            <path fill="#fbc2b2" d="M0 15h48v20H0z"/>
                                            <path d="M24 13a12 12 0 1012 12 12 12 0 00-12-12z" fill="#fff"/>
                                            <path d="M24 15a10 10 0 1010 10 10 10 0 00-10-10z" fill="#56697a"/>
                                            <path d="M24 19a6 6 0 106 6 6 6 0 00-6-6z" fill="#1d2226"/>
                                            <circle cx="24" cy="25" r="2" fill="#fdf9f3"/>
                                        </svg>
                                    </label>
                                    <input type="file" class="fileInputPhoto" name="filePhoto" id="topcard_filePhoto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="art-cov-step" aria-labelledby="modal-header">
                        <div class="header__topcard">
                            <div class="go-back-arrow" id="go-back-home" aria-label="Back" role="button" data-focusable="true" tabIndex="0">
                                <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
                            </div>
                            <div class="a-modal-site-log-wrapper" style="padding-left:5rem;">
                                <img width="40px" height="40px"  src="frontend\assets\favicon\icons8-link-100.png" alt="" class="">
                            </div>
                            <div class="p-btn" id="a-modal-skip">
                                Skip for now
                            </div>
                        </div>
                    </div>
                    <div class="modal-body__topcard-cov">
                        <div class="modal-body__topcard-heading">
                            <h1 class="">Pick a header</h1>
                            <p class="">People who visit your profile will see it. Show your style.</p>  
                        </div>
                        <div class="modal-body__topcard-container-cover">
                            <div class="edit-profile-cov__topcard-wrapper">
                                <img  src="<?php echo url_for($profileData->profileCover);?>" alt="<?php echo $profileData->firstName.' '.$profileData->lastName;?>" class="">
                            </div>
                            <div class="topcard-btn-icon">
                                    <label for="topcard-covfilePhoto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" id="camera-small" data-supported-dps="48x48">
                                            <path d="M46 8H30.52l-2.59-3.27a2.33 2.33 0 00-1.7-.73h-4.46a2.33 2.33 0 00-1.7.73L17 8H2a2.42 2.42 0 00-2 2v30a2.42 2.42 0 002 2h44a2.42 2.42 0 002-2V10a2.42 2.42 0 00-2-2z" fill="#56697a"/>
                                            <path fill="#788fa5" d="M0 10h48v30H0z"/>
                                            <path fill="#fbc2b2" d="M0 15h48v20H0z"/>
                                            <path d="M24 13a12 12 0 1012 12 12 12 0 00-12-12z" fill="#fff"/>
                                            <path d="M24 15a10 10 0 1010 10 10 10 0 00-10-10z" fill="#56697a"/>
                                            <path d="M24 19a6 6 0 106 6 6 6 0 00-6-6z" fill="#1d2226"/>
                                            <circle cx="24" cy="25" r="2" fill="#fdf9f3"/>
                                        </svg>
                                    </label>
                                    <input type="file" class="fileInputPhoto" name="filePhoto" id="topcard_covfilePhoto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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