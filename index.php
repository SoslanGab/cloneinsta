<?php
session_start();
if (isset($_SESSION['id'])) {
    header('Location: profil.php');
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
            <form class="form form-login">
                <fieldset>
                <legend>Please, enter your email and password for login.</legend>
                <div class="input-block">
                    <label for="login-email">E-mail</label>
                    <input id="login-email" type="email" required>
                </div>
                <div class="input-block">
                    <label for="login-password">Password</label>
                    <input id="login-password" type="password" required>
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
            <form class="form form-signup">
                <fieldset>
                <legend>Please, enter your email, password and password confirmation for sign up.</legend>
                <div class="input-block">
                    <label for="signup-email">E-mail</label>
                    <input id="signup-email" type="email" required>
                </div>
                <div class="input-block">
                    <label for="signup-password">Password</label>
                    <input id="signup-password" type="password" required>
                </div>
                <div class="input-block">
                    <label for="signup-password-confirm">Confirm password</label>
                    <input id="signup-password-confirm" type="password" required>
                </div>
                </fieldset>
                <button type="submit" class="btn-signup">Continue</button>
            </form>
            </div>
        </div>
    </section>





    <div>
        <form action="actions/user-login.php" method="post">
            <label for="login">Login:</label>
            <input type="text" name="login" required="required" <?php if (isset($_COOKIE['login'])) {
                                                                    echo "value=\"{$_COOKIE['login']}\"";
                                                                } ?>>
            <label for="login">Password:</label>
            <input type="password" name="password" required="required">
            <input type="checkbox" name="rememberMe" checked>Remember me</input>
            <input type="checkbox" name="stayLoggedIn">Stay logged in</input>
            <button type="submit">Log in</button>
        </form>
        <a href="signup.php"><button>Sign up</button></a>
    </div>
    <?= $_SERVER["REMOTE_ADDR"] ?>
    <pre>
<?= var_dump($_SESSION) ?>
</pre>
    <pre>
<?= var_dump($_COOKIE) ?>
</pre>




<script src="assets/js/main.js"></script> 
</body>
</html>

