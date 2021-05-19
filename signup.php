<?php 
Include 'backend\initialize.php'; 
Include 'backend\shared\register_handlers.php';

$pageTitle="Signup | WeLink";
?>

<section class="signup-container">
<?php require_once 'backend\shared\loginNav.php';?>
    <div class="form-container">
        <div class="form-content">
            <h2 class="header-form-content">
                Create your account
            </h2>
            <form action="<?php echo h($_SERVER['PHP_SELF']);?>" method="POST" class="formField">
                <div class="form-group">
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <label for="firstName">First Name</label>
                    <Input type="text" name="firstName" id="firstName" value="<?php getInputValue('firstName');?>" autocomplete="off" required></Input>
                </div>
                <div class="form-group">
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <label for="lastName">Last Name</label>
                    <Input type="text" name="lastName" id="lastName" value="<?php getInputValue('lastName');?>" autocomplete="off" required></Input>
                </div>
                <div class="form-group">
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?> 
                    <label for="email">Email</label>
                    <Input type="email" name="email" id="email" value="<?php getInputValue('email');?>" autocomplete="off" required></Input>
                </div>
                <div class="form-group">
                    <?php echo $account->getError(Constants::$passwordDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$passwordTooShort); ?>
                    <?php echo $account->getError(Constants::$passwordAlphaNumeric); ?> 
                    <label for="password">Password</label>
                    <Input type="password" name="password" id="password" autocomplete="off" required></Input>
                </div>
                <div class="form-group">
                    <label for="password2">Confirm Password</label>
                    <Input type="password" name="password2" id="password2" autocomplete="off" required></Input>
                </div>
                <div class="s-password">
                    <input type="checkbox" class="form-checkbox" id="s-password" onclick="showPassword()">
                    <label for="s-password">Show password</label>
                </div>
                <div class="form-btn-wrapper">
                    <button type="submit" class="btn-form">Signup</button>
                    <input type="checkbox" class="form-checkbox" id="check" name="remember">
                    <label for="remember">Remember me</label>
                </div>
            </form>
        </div>
        <footer class="form-footer">
                <p>Already have an account?<a href="login">Login now</a></p>
        </footer>
    </div>
</section>

<script src="frontend\assets\js\showPassword.js"></script>