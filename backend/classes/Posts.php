<?php

class Posts{

    private $pdo;
    private $user;
    // private $postControls;

    public function __construct(){
        $this->pdo = Database::Instance();
        $this->user = new User;
        // $this->postControls = new PostsControls;
    }

    public function posts($user_id,$num){
        $stmt = $this->pdo->prepare("SELECT * FROM `post` , `users` WHERE `postBy`=`user_id` AND `user_id` =:userId ORDER BY postedOn DESC LIMIT :num");
        $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":num",$num,PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($posts as $post){
            $postControls = new PostsControls;
            $controls = $postControls->createControls($post->postID,$post->postBy,$user_id);
            echo'<article role="article" data-focusable="true" tabIndex="0" class="post">
            <div class="mainContentContainer">
                <a href="'.url_for($post->username).'" role="link" class="userImageContainer">
                    <img src="'.url_for($post->profileImage).'" alt="'.$post->firstName.' '.$post->lastName.'">
                </a>
                <div class="postContentContainer">
                    <div class="post-header">
                        <div class="post-header-feature-left">
                            <a href="'.url_for($post->username).'" class="displayName">'.$post->firstName.' '.$post->lastName.'</a>
                            <span class="username">@'. $post->username.'</span>
                            <span class="date">'.$this->user->timeAgo($post->postedOn).'</span>
                        </div>
                        '.(($post->postBy===$user_id) ? '<span class="dot deletePostButton" id="deletePostModal" data-post="'.$post->postID.'" data-postBy="'.$post->postBy.'" data-user="'.$user_id.'">
                        <svg class="dot-icon" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 24 24"><g><path d="M19.39 14.882c-1.58 0-2.862-1.283-2.862-2.86s1.283-2.862 2.86-2.862 2.862 1.283 2.862 2.86-1.284 2.862-2.86 2.862zm0-4.223c-.75 0-1.362.61-1.362 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36zM12 14.882c-1.578 0-2.86-1.283-2.86-2.86S10.42 9.158 12 9.158s2.86 1.282 2.86 2.86S13.578 14.88 12 14.88zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.362 1.36 1.362 1.36-.61 1.36-1.36-.61-1.363-1.36-1.363zm-7.39 4.223c-1.577 0-2.86-1.283-2.86-2.86S3.034 9.16 4.61 9.16s2.862 1.283 2.862 2.86-1.283 2.862-2.86 2.862zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36z"/></g></svg>
                    </span>' : '').'
                    </div>
                    <div class="post-body">
                        <div class="">'.$post->status.'</div>
                    </div>
                    '.$controls.'
                </div>
            </div>
        </article> ';
        }
        
    }
    
    public function profilePost($user_id,$num){
        $stmt = $this->pdo->prepare("SELECT * FROM `post` , `users` WHERE `postBy`=`user_id` AND `user_id` =:userId ORDER BY postedOn DESC LIMIT :num");
        $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":num",$num,PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($posts as $post){
            $postControls = new PostsControls;
            $controls = $postControls->createControls($post->postID,$post->postBy,$user_id);
            echo'<article role="article" data-focusable="true" tabIndex="0" class="post">
            <div class="mainContentContainer">
                <a href="'.url_for($post->username).'" role="link" class="userImageContainer">
                    <img src="'.url_for($post->profileImage).'" alt="'.$post->firstName.' '.$post->lastName.'">
                </a>
                <div class="postContentContainer">
                    <div class="post-header">
                        <div class="post-header-feature-left">
                            <a href="'.url_for($post->username).'" class="displayName">'.$post->firstName.' '.$post->lastName.'</a>
                            <span class="username">@'. $post->username.'</span>
                            <span class="date">'.$this->user->timeAgo($post->postedOn).'</span>
                        </div>
                        <span class="dot deletePostButton" id="deletePostModal">
                            <svg class="dot-icon" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 24 24"><g><path d="M19.39 14.882c-1.58 0-2.862-1.283-2.862-2.86s1.283-2.862 2.86-2.862 2.862 1.283 2.862 2.86-1.284 2.862-2.86 2.862zm0-4.223c-.75 0-1.362.61-1.362 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36zM12 14.882c-1.578 0-2.86-1.283-2.86-2.86S10.42 9.158 12 9.158s2.86 1.282 2.86 2.86S13.578 14.88 12 14.88zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.362 1.36 1.362 1.36-.61 1.36-1.36-.61-1.363-1.36-1.363zm-7.39 4.223c-1.577 0-2.86-1.283-2.86-2.86S3.034 9.16 4.61 9.16s2.862 1.283 2.862 2.86-1.283 2.862-2.86 2.862zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36z"/></g></svg>
                        </span>
                    </div>
                    <div class="post-body">
                        <div class="">'.$post->status.'</div>
                    </div>
                    '.$controls.'
                </div>
            </div>
        </article> ';
        }
           
    }

    public function getTrendByHash($hashtag){
        $stmt = $this->pdo->prepare("SELECT DISTINCT `hashtag` FROM `trends` WHERE `hashtag` LIKE :hashtag LIMIT 5");
        $stmt->bindValue(":hashtag",$hashtag.'%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getMention($mention){
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `username` LIKE :mention OR `firstName` LIKE :mention OR `lastName` LIKE :mention LIMIT 5");
        $stmt->bindValue(":mention",$mention.'%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function addTrend($hashtag,$postID,$user_id){
        preg_match_all("/#+([a-zA-Z0-9_]+)/i",$hashtag,$matches);
        if($matches){
            $result = array_values($matches[1]);
        }

        $sql = "INSERT INTO `trends` (`hashtag`,`postID`,`user_id`,`createdOn`) VALUES (:hashtag,:postID,:userId,:dateOn)";

        foreach($result as $trend){
            if($stmt = $this->pdo->prepare($sql)){
                $stmt->execute(array(':hashtag'=>$trend,':postID'=>$postID,':userId'=>$user_id,':dateOn'=>date('Y-m-d H:i:s')));
            }
        }
    }

    public function getLikes($postId){
        $stmt = $this->pdo->prepare("SELECT count(*) as `count` FROM `likes` WHERE `likeOn` =:postId");
        $stmt ->bindParam(":postId",$postId,PDO::PARAM_INT);
        $stmt ->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data["count"] > 0 ){
            return $data["count"];
        } 
    }

    public function likes($user_id,$postId){
       if($this->wasLikedBy($user_id,$postId)){
           //user has already likes
           $this->user->delete("likes",array("likeBy" => $user_id, "likeOn" =>$postId));
           $result = array("likes"=>-1);
           return json_encode($result);
       }else{
           //user has not liked.
        //    echo "Not liked";
            $this->user->create("likes",array("likeBy" => $user_id, "likeOn" =>$postId));
            $result = array("likes"=>1);
            return json_encode($result);
       }
    }

    public function wasLikedBy($user_id,$postId){
        $stmt = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` =:userId AND `likeOn` =:postId");
        $stmt ->bindParam(":userId",$user_id,PDO::PARAM_INT);
        $stmt ->bindParam(":postId",$postId,PDO::PARAM_INT);
        $stmt ->execute();
        return $stmt ->rowCount() > 0;
    }

    public function PostCounts($profileId){
        $stmt = $this->pdo->prepare("SELECT count('postID') as `postCount` FROM `post` WHERE `postBy` =:profileId");
        $stmt->bindParam(":profileId",$profileId,PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data["postCount"] > 0){
            return $data["postCount"];
        }
    }

    public function createTab($name,$href,$isSelected){
        $className = $isSelected ? "tab active":"tab";
        return "<a href='$href' class='$className'>
            <span>$name</span>
            </a>";
    }
}



?>