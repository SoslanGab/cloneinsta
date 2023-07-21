<?php


require 'connection.php';

try {
    $prepareUsers = $pdoInsta ->prepare("SELECT * FROM users");
    $prepareUsers->execute();
    $fetchedUsers = $prepareUsers->fetchAll();
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../signup.php?err=signupUsernameFetch');
    exit();
}