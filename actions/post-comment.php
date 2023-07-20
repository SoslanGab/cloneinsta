<?php

session_start();

$content = htmlspecialchars($_POST['commentConent']);
$pictureId = $_POST['pictureId'];
$posterId = $_SESSION['idUser'];


require 'connection.php';


try {
    $prepareInsertComment = $pdoInsta->prepare("INSERT INTO comments (content, poster_id, picture_id) VALUES (:content, :poster_id, :picture_id)");
    $prepareInsertComment->execute([
        ':content' => $content,
        ':poster_id' => $posterId,
        ':picutre_id' => $pictureId
    ]);
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../profile.php?err=postCommentFailed');
    exit();
}
