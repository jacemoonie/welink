$(function(){
    let uid=$(".u-p-id").data("uid");
    let win = $(window);
    let offset = 5;

    win.scroll(function(){
        let content_height = $(document).height();
        let content_y = win.height()+win.scrollTop();
        // console.log(content_y + content_height);

        if(content_height <= content_y){
            offset = offset + 10;
            $.post("http://localhost/welink/backend/ajax/fetchPosts.php",{fetchPosts:offset,userId:uid},function(data){
                $(".postContainer").html(data);
            })
        }
    })
})