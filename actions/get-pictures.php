<?php


require 'connection.php';

try {
    $prepareGetPictures = $pdoInsta ->prepare("SELECT * FROM pictures INNER JOIN users ON pictures.poster_id = users.id");
    $prepareGetPictures->execute();
    $fetchedPictures = $prepareGetPictures->fetchAll();
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../profile.php?err=getPicturesFailed');
    exit();
}


