<?php


require 'connection.php';

try {
    $prepareUsers = $pdoInsta ->prepare("SELECT * FROM users ORDER BY last_post DESC");
    $prepareUsers->execute();
    $fetchedUsers = $prepareUsers->fetchAll();
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../signup.php?err=signupUsernameFetch');
    exit();
}