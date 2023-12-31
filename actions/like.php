<?php

session_start();

$data = json_decode(file_get_contents('php://input'), true);
$pictureId = $data['pictureId'];
$posterId = $_SESSION['idUser'];
$verification = verifyIfAlreadyLiked($pictureId, $posterId);
like($pictureId, $posterId, $verification);



function verifyIfAlreadyLiked($pictureId, $posterId)
{

    require 'connection.php';

    try {
        $prepareLike = $pdoInsta->prepare("SELECT * FROM likes WHERE picture_id = :picture_id AND poster_id = :poster_id");
        $prepareLike->execute([
            ':picture_id' => $pictureId,
            ':poster_id' => $posterId
        ]);
        $fetchedLike = $prepareLike->fetchAll();
    } catch (PDOException $exception) {
        $_SESSION['lastErrMsg'] = $exception->getMessage();
        header('Location: ../signup.php?err=signupUsernameFetch');
        exit();
    }

    return $fetchedLike;
}



function postLike($pictureId, $posterId)
{

    require 'connection.php';

    try {
        $prepareInsertComment = $pdoInsta->prepare("INSERT INTO likes (poster_id, picture_id) VALUES (:poster_id, :picture_id)");
        $prepareInsertComment->execute([
            ':picture_id' => $pictureId,
            ':poster_id' => $posterId,
        ]);
        $success = [
            "likestatus" => "posted", 
        ];
        echo json_encode($success);
    } catch (PDOException $exception) {
        $_SESSION['lastErrMsg'] = $exception->getMessage();
        header('Location: ../index.php?err=postCommentFailed');
        exit();
    }
}



function removeLike($pictureId, $posterId)
{

    require 'connection.php';

    try {
        $prepareInsertComment = $pdoInsta->prepare("DELETE FROM likes WHERE picture_id = :picture_id AND poster_id = :poster_id");
        $prepareInsertComment->execute([
            ':picture_id' => $pictureId,
            ':poster_id' => $posterId,
        ]);
        $success = [
            "likestatus" => "removed", 
        ];
        echo json_encode($success);
    } catch (PDOException $exception) {
        $_SESSION['lastErrMsg'] = $exception->getMessage();
        header('Location: ../index.php?err=postCommentFailed');
        exit();
    }
}



function like($pictureId, $posterId, $verification)
{

    if ($verification !== []) {
        removeLike($pictureId, $posterId);
    } elseif ($verification === []) {
        postLike($pictureId, $posterId);
    } else {
        echo "something went wrong!";
        exit();
    }
}
