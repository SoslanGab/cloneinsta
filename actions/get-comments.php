<?php

$data = json_decode(file_get_contents('php://input'), true);
$pictureId = $data['pictureId'];

require 'connexion.php';

try {
    $prepareGetComment = $pdoChat->prepare("SELECT * FROM comments WHERE picutre_id = :picutre_id");
    $prepareGetComment->execute([':picutre_id' => $pictureId]);
    $fetchedComment = $prepareGetComment->fetchAll();
} catch (PDOException $exception) {
    $_SESSION['lastErrMsg'] = $exception->getMessage();
    header('Location: ../signup.php?err=signupUsernameFetch');
    exit();
}

echo json_encode($fetchedComment);