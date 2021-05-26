function likePost(button,postId,likedBy,postedBy){
    let postID = postId;
    let likeBy = likedBy;
    let postBy = postedBy;
    $.post("http://localhost/welink/backend/ajax/likePost.php",{postId:postID,likedBy:likeBy,likeOn:postBy},function(data){   
        let likeButton = $(button);
        likeButton.addClass("like-active");
        let result = JSON.parse(JSON.stringify(data));
        updatesLikeValue(likeButton.find(".likesCounter"),result.likes);
        
        if(result.likes < 0){
            likeButton.removeClass(".likesCounter");
            likeButton.find(".fa-heart").addClass("fa-heart-o");
            likeButton.find(".fa-heart-o").removeClass("fa-heart");
        }else{
            likeButton.addClass(".likesCounter");
            likeButton.find(".fa-heart-o").addClass("fa-heart");
            likeButton.find(".fa-heart").removeClass("fa-heart-o");
        }
        location.reload(true);
        // console.log(data);
        // alert(result);
    })
}

function updatesLikeValue(element,num){
    let likesCountVal = element.text() || "0";
    element.text(parseInt(likesCountVal) + parseInt(num));
}