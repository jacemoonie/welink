$(function(){
    let uid = $(".u-p-id").data("uid");
    let pid = $(".u-p-id").data("pid");
    let win = $(window);
    let offset = 10;

    win.scroll(function(){
        let content_height = $(document).height();
        let content_y = win.height()+win.scrollTop();
        // console.log(content_y + "/"+content_height);

        if(content_y >= content_height-1){
            offset += 10;
            if(uid == pid){
                $.post("http://localhost/welink/backend/ajax/fetchPosts.php",{fetchPosts:offset,userId:uid},function(data){   
                $(".postContainer").html(data);
                $(".profilePostContainer").html(data);
                })
            }else{
                $.post("http://localhost/welink/backend/ajax/fetchPosts.php",{fetchPosts:offset,userId:pid},function(data){   
                $(".postContainer").html(data);
                $(".profilePostContainer").html(data);
                })
            }
        }
    })
})