$(function(){
    var modal = document.querySelector(".d-wrapper-container");
    var deleteModal = document.querySelector(".del-post-wrapper-container");
 
    $(document).on("click","#deletePostModal",function(){
        $postID = $(this).data('post');
        $postBy = $(this).data('postby');
        $userId = $(this).data('user');
        modal.style.display = "block";
    })

    window.onclick = function(event) {

        if (event.target == modal) {
     
           modal.style.display = "none";
     
         }
         if (event.target == deleteModal) {
     
            deleteModal.style.display = "none";
      
          }
     
     }

    $(document).on("click","#del-content",function(){
        deleteModal.style.display = "block";
    }) 
    $(document).on("click","#cancel",function(){
        deleteModal.style.display = "none";
        modal.style.display = "none";
    }) 
    $(document).on("click","#delete-post-btn",function(){
        $.post("http://localhost/welink/backend/ajax/deletePost.php",{postId:$postID,userId:$userId,postBy:$postBy},function(data){   
                // alert(data);
                deleteModal.style.display = "none";
                modal.style.display = "none";
                $(".postContainer").html(data);
                location.reload(true);
        })
    }) 
    
})