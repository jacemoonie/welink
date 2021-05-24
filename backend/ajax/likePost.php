<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['postId']) && !empty($_POST['postId'])){
        
        $likeBy = h($_POST['likedBy']);
        $postID = h($_POST['postId']);
        $postedBy = h($_POST['likeOn']);

        echo $loadFromPosts->likes($likeBy,$postID);

    }
        
    
}

?>