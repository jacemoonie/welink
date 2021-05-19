<?php 
Include 'backend\initialize.php'; 
Include 'backend\shared\login_handlers.php';

    

$pageTitle="Signup | WeLink";

?>


<section class="signup-container">
<?php Include 'backend\shared\loginNav.php'; ?>
    <div class="form-container">
        <div class="form-content">
            <h2 class="header-form-content">
                Log in to WeLink
            </h2>
            <form action="<?php echo h($_SERVER['PHP_SELF']);?>" method="POST" class="formField">
                <div class="form-group">
                <?php echo $account->getError(Constants::$loginPasswordWrong); ?>
                <?php echo $account->getError(Constants::$loginUsernameEmailWrong); ?>
                    <label for="username">Username or Email</label>
                    <Input type="text" name="username" id="username" value="<?php getInputValue('username');?>" autocomplete="off" required></Input>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <Input type="password" name="password" id="password" autocomplete="off" required></Input>
                </div>
                <div class="s-password">
                    <input type="checkbox" class="form-checkbox" id="s-password" onclick="showLoginPassword()">
                    <label for="s-password">Show password</label>
                </div>
                <div class="form-btn-wrapper">
                    <button type="submit" class="btn-form">Log In</button>
                    <input type="checkbox" class="form-checkbox" id="check" name="remember">
                    <label for="remember">Remember me</label>
                </div>
            </form>
        </div>
        <footer class="form-footer">
                <p>New to WeLink?<a href="signup">Signup for WeLink</a></p>
        </footer>
    </div>
</section>

<script src="frontend\assets\js\showPassword.js"></script>