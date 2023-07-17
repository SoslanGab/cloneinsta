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
    <title>Log In</title>
</head>

<body>

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
</body>

</html>