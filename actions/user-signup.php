<?php
session_set_cookie_params(time() + 86400 * 365, "/", true, true);
session_start();
unset($_SESSION['signupErr']);

$registerDate = date("Y-m-d");


function validateLogin($login)
{
    if (empty($login)) {
        return "Login is required.";
    } elseif (!preg_match('/^[a-zA-Z0-9]{6,12}$/', $login)) {
        return "The login does not meet the requirements!";
    }
    return null;
}


function validatePassword($password, $confirmPassword)
{
    if (empty($password)) {
        return "Password is required.";
    } elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[^0-9A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/', $password)) {
        return 'The password does not meet the requirements!';
    } elseif ($password !== $confirmPassword) {
        return "Password confirmation does not match!";
    }
    return null;
}


function validateUsername($username, $login)
{
    if (empty($username)) {
        return "Username is required.";
    } elseif (!preg_match('/^[a-zA-Z0-9]{2,12}$/', $username)) {
        return "The username does not meet the requirements!";
    } elseif (strtolower($username) === $login) {
        return "The username must be different from the login!";
    }
    return null;
}


function signup($login, $password, $username, $image, $date)
{
    require 'connection.php';

    try {
        $queryLogin = $pdoInsta->prepare("SELECT * FROM users WHERE login = :login");
        $queryLogin->execute([':login' => $login]);
        $fetchedLogin = $queryLogin->fetchAll();
    } catch (PDOException $exception) {
        $_SESSION['lastErrMsg'] = $exception->getMessage();
        header('Location: ../signup.php?err=signupLoginFetch');
        exit();
    }

    try {
        $queryUsername = $pdoInsta->prepare("SELECT * FROM users WHERE username = :username");
        $queryUsername->execute([':username' => $username]);
        $fetchedUsername = $queryUsername->fetchAll();
    } catch (PDOException $exception) {
        $_SESSION['lastErrMsg'] = $exception->getMessage();
        header('Location: ../signup.php?err=signupUsernameFetch');
        exit();
    }

    if (empty($fetchedLogin) && empty($fetchedUsername)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $prepareSignup = $pdoInsta->prepare("INSERT INTO users (username, login, password, pfpLink, register_date) VALUES (:username, :login, :password, :image, :register_date)");
            $prepareSignup->execute([
                ':username' => $username,
                ':login' => $login,
                ':password' => $passwordHash,
                ':image' => $image,
                ':register_date' => $date

            ]);
        } catch (PDOException $exception) {
            $_SESSION['lastErrMsg'] = $exception->getMessage();
            header('Location: ../signup.php?err=pdoSignupErr');
            exit();
        }

        try {
            $pdoGetIdForLogIn = $pdoInsta->prepare("SELECT * FROM users WHERE login = :login");
            $pdoGetIdForLogIn->execute([':login' => $login]);
            $fetchGetIdForLogIn = $pdoGetIdForLogIn->fetch();
        } catch (PDOException $exception) {
            $_SESSION['lastErrMsg'] = $exception->getMessage();
            header('Location: ../index.php?err=loginFetch');
            exit();
        }

        $_SESSION['idUser'] = $fetchGetIdForLogIn['id'];
        $_SESSION['username'] = $fetchGetIdForLogIn['username'];
        $_SESSION['pfpLink'] = $fetchGetIdForLogIn['pfpLink'];
        header("Location: ../profile.php");
        exit();
    } else {
        if (!empty($fetchedLogin)) {
            $_SESSION['loginAlreadyInUse'] = true;
        }
        if (!empty($fetchedUsername)) {
            $_SESSION['usernameAlreadyInUse'] = true;
        }
        header('Location: ../signup.php?err=signupAlreadyInUse');
        exit();
    }
}



$login = strtolower($_POST['createLogin']);
$password = $_POST['createPassword'];
$username = $_POST['createUsername'];
$confirmPassword = $_POST['confirmPassword'];
$imgUploadError = $_FILES['uploadProfileImage']['error'];

$loginErr = validateLogin($login);
$passwordErr = validatePassword($password, $confirmPassword);
$usernameErr = validateUsername($username, $login);

if ($loginErr || $passwordErr || $usernameErr) {
    $_SESSION['signupErr']['createLogin'] = $loginErr;
    $_SESSION['signupErr']['createPassword'] = $passwordErr;
    $_SESSION['signupErr']['createUsername'] = $usernameErr;
    header('Location: ../signup.php?err=signupRequirements');
    exit();
}

if ($imgUploadError === UPLOAD_ERR_OK) {
    $fileExtension = pathinfo($_FILES['uploadProfileImage']['name'], PATHINFO_EXTENSION);
    $imgDestinationPath = "../uploads/{$username}.{$fileExtension}";
    $imgPath = "uploads/{$username}.{$fileExtension}";
    move_uploaded_file($_FILES['uploadProfileImage']['tmp_name'], $imgDestinationPath);
} elseif ($imgUploadError !== UPLOAD_ERR_NO_FILE) {
    $errorCode = $_FILES['uploadProfileImage']['error'];
    $phpFileUploadErrors = [
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    ];
    if (isset($phpFileUploadErrors[$errorCode])) {
        $_SESSION['signupErr']['uploadProfileImage'] = $phpFileUploadErrors[$errorCode];
    } else {
        $_SESSION['signupErr']['uploadProfileImage'] = "Unknown Error";
    }
}

if (isset($login) && isset($password) && isset($username) && isset($imgPath) && isset($registerDate) && !isset($_SESSION['signupErr'])) {
    signup($login, $password, $username, $imgPath, $registerDate);
} else {
    echo "Something went wrong!";
    echo $_SESSION['signupErr'];
    exit();
}
