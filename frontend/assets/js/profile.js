// let uid=$(".u-p-id").data("uid");
var cropper;
$(function(){
    var modal = document.querySelector(".modal-pic");
    var profileModal = document.querySelector(".art-pic-step");
    var previewContainer = document.querySelector(".modal-preview-container");
    var coverModal = document.querySelector(".art-cov-step");

    $(document).on("click","#set-up-profile",function(){
        modal.style.display = "block";
        coverModal.style.display = "none";
        profileModal.style.display = "block"; 
    })
    $(document).on("click","#a-modal-skip",function(){
        coverModal.style.display = "block";
        profileModal.style.display = "none";   
    })
    $(document).on("click",".profile-go-back",function(){
        coverModal.style.display = "none";
        previewContainer.style.display = "none";
        profileModal.style.display = "block";  
        $("#topcard_filePhoto").value("");
    })
    $(document).on("click",".cover-go-back",function(){
        previewContainer.style.display = "none";
        profileModal.style.display = "none";  
        coverModal.style.display = "block";
        $("#topcard_covfilePhoto").val("");
        let hasClassCover = $(this).hasClass("cover-go-back");
        if(hasClassCover){
            $(".go-back-arrow").addClass("profile-go-back").removeClass("cover-go-back");
        }
    })
    
    $(document).on("change","#topcard_filePhoto",function(){
        // console.log(this.files[0]);
        if(this.files && this.files[0]){
            profileModal.style.display = "none";
            $(".go-back-arrow").addClass("profile-go-back").removeClass("cover-go-back");
            previewContainer.style.display = "block";
            let reader = new FileReader();
            reader.onload = function(e){
                let image = document.getElementById("imagePreview");
                image.src = e.target.result;
                if(cropper !== undefined){
                    cropper.destroy();
                }
                cropper = new Cropper(image,{
                    aspectRatio: 1/1,
                    background:false
                })
                // console.log(e);
            }
            reader.readAsDataURL(this.files[0]);
        }
    })

    $(document).on("click","#imageUploadButton",function(){
        
        let isProfile = $(".go-back-arrow").hasClass("profile-go-back");
        if(isProfile){
            var name = document.getElementById("topcard_filePhoto").files[0];
            let canvas = cropper.getCroppedCanvas();
            if(canvas == null){
                alert("Could not upload image, invalid image file");
                return;
            }
            canvas.toBlob((blob)=>{
                let formData = new FormData();
                formData.append("croppedImage",blob);
                formData.append("userId",uid);
                $.ajax({
                    url:"http://localhost/welink/backend/ajax/profilePhoto.php",
                    data:formData,
                    type:'POST',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        // console.log("success");
                        location.reload(true);
                    },
                    error: function(data){
                        console.log("error");
                        console.log(data);
                    }
                })
               
            })
            
        }else{
            var name = document.getElementById("topcard_covfilePhoto").files[0];
            let canvas = cropper.getCroppedCanvas();
            if(canvas == null){
                alert("Could not upload image, invalid image file");
                return;
            }
            canvas.toBlob((blob)=>{
                let formData = new FormData();
                formData.append("croppedCoverImage",blob);
                formData.append("userId",uid);
                $.ajax({
                    url:"http://localhost/welink/backend/ajax/profilePhoto.php",
                    data:formData,
                    type:'POST',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        // console.log("success");
                        location.reload(true);
                    },
                    error: function(data){
                        console.log("error");
                        console.log(data);
                    }
                })
               
            })
        }


    })

    $(document).on("change","#topcard_covfilePhoto",function(){
  
        // console.log(this.files[0]);
        if(this.files && this.files[0]){
            coverModal.style.display = "none";
            $(".go-back-arrow").removeClass("profile-go-back").addClass("cover-go-back");
            previewContainer.style.display = "block";
            let reader = new FileReader();
            reader.onload = function(e){
                let image = document.getElementById("imagePreview");
                image.src = e.target.result;
                if(cropper !== undefined){
                    cropper.destroy();
                }
                cropper = new Cropper(image,{
                    aspectRatio: 16/9,
                    background:false
                })
            }
            reader.readAsDataURL(this.files[0]);
        }
        else{
            alert("NOTHING hERERERERERER");
        }
    })

    window.onclick = function(event) {

        if (event.target == modal) {
     
           modal.style.display = "none";
     
         }
     
     }
})