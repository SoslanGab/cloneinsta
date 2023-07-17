<?php
session_start();
if (isset($_SESSION['idUser'])) {
    header('Location: profile.php?info=userLoggedIn');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/css_index.css" >
    <title>Log In</title>
</head>

<body>

    <section class="forms-section">
        <h1 class="section-title">Animated Forms</h1>
        <div class="forms">
            <div class="form-wrapper is-active">
                <button type="button" class="switcher switcher-login">
                    Login
                    <span class="underline"></span>
                </button>
                <form action="actions/user-login.php" method="post" class="form form-login">
                    <fieldset>
                    <legend>Merci de rentrer votre login</legend>
                    <div class="input-block">
                        <label for="login-email">Login</label>
                        <input id="login-email"  type="text" name="login" required="required" <?php if (isset($_COOKIE['login'])) {
                                                                    echo "value=\"{$_COOKIE['login']}\"";
                                                                } ?>>
                    </div>
                    <div class="input-block">
                        <label for="password">Password</label>
                        <input type="password" name="password" required="required">
                    </div>
                    <div class="">
                        <input type="checkbox" name="rememberMe" checked>Remember me</input>
                        <input type="checkbox" name="stayLoggedIn">Stay logged in</input>
                    </div>
                    </fieldset>
                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
            <div class="form-wrapper">
            <button type="button" class="switcher switcher-signup">
                Sign Up
                <span class="underline"></span>
            </button>
            <form action="actions/user-signup.php" method="POST" enctype="multipart/form-data" id="signupForm" class="form form-signup">
                <fieldset>
                    <legend>Veuillez remplir ce formulaire pour pouvoir vous inscrire</legend>
                    <div class="input-block">
                        <label for="createUsername">Username :</label>
                        <input type="text" name="createUsername" required>                                          
                    </div>
                    <div class="input-block">
                        <label for="signup-email">Login</label>
                        <input type="text" name="createLogin"  id="signup-email" required>
                    </div>
                    <div class="input-block">
                        <label for="signup-password">Password</label>
                        <input type="password" name="createPassword" required>
                    </div>
                    <div class="input-block">
                        <label for="signup-password-confirm">Confirm password</label>
                        <input type="password" name="confirmPassword" required>
                    </div>
                    <div class="input-block">
                    <label for="uploadProfileImage">Profile picture :</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
                        <input type="file" name="uploadProfileImage" accept="image/*">
                    </div>
                </fieldset>
                <button type="submit" class="btn-signup">Continue</button>
            </form>
            </div>
        </div>
    </section>





    <div>

        <a href="signup.php"><button>Sign up</button></a>
    </div>
    <?= $_SERVER["REMOTE_ADDR"] ?>
    <pre>
<?= var_dump($_SESSION) ?>
</pre>
    <pre>
<?= var_dump($_COOKIE) ?>
</pre>




<script src="assets/js/index.js"></script> 
</body>
</html>

