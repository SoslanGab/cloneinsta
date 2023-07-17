<?php
session_start();
if (isset($_SESSION['id'])) {
    header('Location: index.php?err=SignUpFailedUserLoggedIn');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <form action="actions/user-signup.php" method="POST" enctype="multipart/form-data" id="signupForm">


        <label for="createPassword">Password :</label>
        <input type="password" name="createPassword" required>
        
        <label for="confirmPassword">Confirm password :</label>
        <input type="password" name="confirmPassword" required>

        <button type="submit">Sign up</button>
    </form>
    <script src="assets/js/main.js"></script>
</body>

</html>