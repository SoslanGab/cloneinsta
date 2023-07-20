<?php

require 'connection.php';

try {
    $prepareGetLikes = $pdoInsta ->prepare("SELECT * FROM likes");
    $prepareGetLikes->execute();
    $fetchedLikes = $prepareGetLikes->fetchAll();
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../profile.php?err=getLikesFailed');
    exit();
}

echo json_encode($fetchedLikes);