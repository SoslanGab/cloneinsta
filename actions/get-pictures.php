<?php


require 'connection.php';

try {
    $prepareGetPicture = $pdoInsta ->prepare("SELECT * FROM pictures INNER JOIN users ON pictures.poster_id = users.id");
    $prepareGetPicture->execute();
    $fetchedPictures = $prepareGetPicture->fetchAll();
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../profile.php?err=getPictureFailed');
    exit();
}

echo "<pre>";
foreach($fetchedPictures as $pic){
    echo print_r($pic);
}
echo "</pre>";
