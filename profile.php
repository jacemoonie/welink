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
      $profileId = $loadFromUser->userIdByUsername($username);
      if(!$profileId){
          redirect_to(url_for("home")); 
      }else{
          $user_id = $profileId;
      }
    }
}
$user = $loadFromUser->userData($user_id);
$profileData = $loadFromUser->userData($user_id);
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
                    <?php if(!empty($loadFromPosts->PostCounts($user_id))){ ?>
                    <div class="tweet-no"><?php echo $loadFromPosts->PostCounts($user_id); ?> Posts</div>
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
                    <button class="edit-profile-btn" role="button">Set up Profile</button>
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
                           <span class="">Following</span>
                        </a>
                        <a href="<?php echo url_for($profileData->username.'/followers'); ?>" class="">
                           <span class="value count-followers">0</span> 
                           <span class="">Followers</span>
                        </a>
                    </div>
                </div>
            </section>
            <div class="tabsContainer">
                <?php echo $loadFromPosts->createTab('Posts',url_for($profileData->username),true);?>
                <?php echo $loadFromPosts->createTab('Replies',url_for($profileData->username,'/replies'),false);?>
            </div>

            <section aria-label="Timeline:Your Profile Timeline" class="profilePostContainer">
                <?php $loadFromPosts->profilePost($user_id,10)?>
            </section>
        </section>
        <aside class="" role="complementary"></aside>
    </main>
</section>

<script src="<?php echo url_for('frontend\assets\js\common.js'); ?>"></script>
<script src="<?php echo url_for('frontend\assets\js\fetchPosts.js'); ?>"></script>
<script src="<?php echo url_for('frontend\assets\js\hashtag.js'); ?>"></script>
<script src="<?php echo url_for('frontend\assets\js\likePost.js'); ?>"></script>