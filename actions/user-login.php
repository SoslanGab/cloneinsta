<?php
session_set_cookie_params(time() + 86400 * 365, "/", true, true);
session_start();


if (isset($_POST['rememberMe']) && !isset($_COOKIE['login'])) {
    setcookie('login', htmlentities($_POST['login']), time() + 86400 * 365, "/");
} elseif (isset($_POST['rememberMe']) && isset($_COOKIE['login']) && $_COOKIE['login'] !== $_POST['login']) {
    setcookie('login', htmlentities($_POST['login']), time() + 86400 * 365, "/");
} elseif (!isset($_POST['rememberMe']) && isset($_COOKIE['login'])) {
    setcookie('login', false, time() - 86400 * 365, "/");
}


require 'connection.php';


$login = htmlspecialchars(strtolower($_POST['login']));


try {
    $queryUsers = $pdoInsta->prepare("SELECT * FROM users WHERE users.login = :login");
    $queryUsers->execute([':login' => $login]);
    $fetchedUser = $queryUsers->fetchAll();
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../index.php?err=loginFetch');
    exit();
}

if ($fetchedUser === []) {
    header('Location: ../index.php?err=loginPassword');
    exit();
}


function login(array $fetch, string $password)
{
    if (password_verify($password, $fetch['password'])) {
        $_SESSION['idUser'] = $fetch['id'];
        $_SESSION['username'] = $fetch['username'];
        $_SESSION['pfpLink'] = $fetch['pfpLink'];
        if (isset($_POST['stayLoggedIn'])) {
            setcookie('stayLoggedIn', true, time() + 86400 * 365, "/");
            setcookie('id', $fetch['id'], time() + 86400 * 365, "/");
            setcookie('username', $fetch['username'], time() + 86400 * 365, "/");
            setcookie('pfpLink', $fetch['pfpLink'], time() + 86400 * 365, "/");
        } else {
            setcookie('stayLoggedIn', false, -1, '/');
            setcookie('id', false, -1, '/');
            setcookie('username', false, -1, '/');
            setcookie('pfpLink', false, -1, '/');
        }
        header('Location: ../profile.php?info=loginSuccess');
        exit();
    } elseif (password_verify($password, $fetch['password'])) {
        header('Location: ../index.php?err=ipAdressDoesNotMatch');
        exit();
    }
    header('Location: ../index.php?err=password');
    exit();
}


login($fetchedUser[0], $_POST['password']);
