<?php

class ButtonProvider{

    public static function createTweetButton($text,$imageSrc,$class,$countClassName,$postId,$postedBy,$user_id){
        return '<button class="'.$class.'" data-post="'.$postId.'" data-postedBy="'.$postedBy.' data-user="'.$user_id.'">
            '.$imageSrc.'
            <span class="'.$countClassName.'">'.$text.'</span>
        </button>';
    }

    public static function createLikeButton($text,$imageSrc,$class,$action,$postId,$postedBy,$user_id){
        return '<button class="'.$class.'" onclick="'.$action.'" data-post="'.$postId.'" data-postedBy="'.$postedBy.' data-user="'.$user_id.'">
            '.$imageSrc.'
            <span class="likesCounter">'.$text.'</span>
        </button>';
    }
}


?>