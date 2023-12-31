<?php

session_start();

$msgContent = htmlspecialchars($_POST['commentConent']);
$pictureId = $_POST['pictureId'];
$posterId = $_SESSION['idUser'];

require 'connection.php';

try {
    $prepareInsertComment = $pdoInsta->prepare("INSERT INTO comments (content, poster_id, picture_id) VALUES (:content, :poster_id, :picture_id)");
    $prepareInsertComment->execute([
        ':content' => $msgContent,
        ':poster_id' => $posterId,
        ':picture_id' => $pictureId
    ]);
    header('Location: ../profile.php?info=commentPosted');
    exit();
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../profile.php?err=commentPostFailed');
    exit();
}