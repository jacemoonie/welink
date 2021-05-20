<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['fetchPosts']) && !empty($_POST['fetchPosts'])){
        $userid = h($_POST['userId']);
        $limit = (int)trim($_POST['fetchPosts']);
        // echo $limit;
        $loadFromPosts->posts($userid,$limit);
    }
}

?>