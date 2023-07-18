<?php

session_start();

$data = json_decode(file_get_contents('php://input'), true);
$content = htmlspecialchars($data['commentConent']);
$pictureId = $data['pictureId'];
$posterId = $_SESSION['idUser'];


require 'connection.php';


try {
    $prepareInsertComment = $pdoChat->prepare("INSERT INTO comments (content, poster_id, picture_id) VALUES (:content, :poster_id, :picture_id)");
    $prepareInsertComment->execute([
        ':content' => $content,
        ':poster_id' => $posterId,
        ':picture_id' => $pictureId,
    ]);
    echo json_encode("success");
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    echo json_encode("failed");
    header('Location: ../index.php?err=postCommentFailed');
    exit();
}
