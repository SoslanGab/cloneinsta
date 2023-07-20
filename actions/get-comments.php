<?php


require 'connection.php';

try {
    $prepareGetComments = $pdoInsta ->prepare("SELECT * FROM comments INNER JOIN users ON comments.poster_id = users.id");
    $prepareGetComments->execute();
    $fetchedComments = $prepareGetComments->fetchAll();
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../signup.php?err=signupUsernameFetch');
    exit();
}