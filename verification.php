<?php 
Include_once 'backend\initialize.php'; 
Include 'backend\shared\verify_handlers.php';

$pageTitle="Verify your Account";
?>
<?php require_once 'backend\shared\header.php';?>
<section class="signup-container">
<?php require_once 'backend\shared\loginNav.php';?>
    <div class="form-container">
        <div class="form-content">
        <?php if(isset($_GET['verify']) || !empty($GET['verify'])){
            if(isset($errors['verify'])){
                echo ' <div class="header-form-content"><h2>'.$errors['verify'].'</h2></div>';
            }
        }else{    
         ?>
        <div class="header-form-content">
            <h2>
                A verification email has been sent to <?php echo $user->email; ?>. Please check your mailbox to verify the account before you sign in.
            </h2>
        </div>
        <?php } ?>
    </div>
    </div>
</section>

</body>
</html>