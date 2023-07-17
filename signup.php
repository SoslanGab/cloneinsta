<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form action="actions/user-signup.php" method="POST" enctype="multipart/form-data" id="signupForm">

        <label for="createUsername">Username :</label>
        <input type="text" name="createUsername" required>
        <label for="createLogin">Login :</label>
        <input type="text" name="createLogin" required>
        <label for="createPassword">Password :</label>
        <input type="password" name="createPassword" required>
        <label for="confirmPassword">Confirm password :</label>
        <input type="password" name="confirmPassword" required>
        <label for="uploadProfileImage">Profile picture :</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
        <input type="file" name="uploadProfileImage" accept="image/*">
        <button type="submit">Sign up</button>
    </form>
    <script src="js/main.js"></script>
</body>

</html>