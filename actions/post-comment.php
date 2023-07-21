<?php

session_start();

$msgContent = htmlspecialchars($_POST['commentConent']);
$pictureId = $_POST['pictureId'];
$posterId = $_SESSION['idUser'];
$lastPost = date("YYYY-MM-DD HH:MM:SS");


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
    header('Location: ../profile.php?err=postCommentFailed');
    exit();
}

try {
    $prepareInsertLastCommentUpdate = $pdoInsta->prepare("UPDATE users SET last_post = :last_post WHERE id = :id");
    $prepareInsertLastCommentUpdate->execute([
        ':last_post' => $msgContent,
        ':id' => $posterId
    ]);
    header('Location: ../profile.php?info=commentPosted');
    exit();
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../profile.php?err=postCommentFailed');
    exit();
}