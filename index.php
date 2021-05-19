<?php 
include 'backend\classes\Database.php';
Include 'backend\initialize.php'; 


if(isset($_SESSION['userLoggedIn'])){
    redirect_to(url_for("home"));
}else if(Login::isLoggedIn()){
    redirect_to(url_for("home"));
}
    
?>

<section class="main-page">
    <div class="left">
        <div class="left-content">
           <div>
            <i class="fas fa-search"></i>
            <h3 class="left-content-heading"> Find your interest</h3>
           </div>
           <div>
            <i class="fas fa-users"></i>
            <h3 class="left-content-heading"> Explore what people are talking about</h3>
           </div>
           <div>
            <i class="fas fa-comment"></i>
            <h3 class="left-content-heading"> Join the people</h3>
           </div> 
        </div>
    </div>
    <div class="right">
        <div class="middle-content">
        <img src="frontend\assets\favicon\icons8-link-100.png" width="50px;" height="50px;">
        <h1> See what's happening in the world right now</h1>
        <h4> Join WeLink now</h4>
        <a href="signup" class="sign-up">Sign up</a>
        <a href="login" class="log-in">Login</a>
        </div>
    </div>

</section>

</body>
</html>