<?php

session_start();


$title = $_POST['title'];
$text = $_POST['text'];
$posterId = $_SESSION['idUser'];
$imgUploadError = $_FILES['uploadPicture']['error'];

postPicture($posterId, $imgDestinationPath, $title, $text);


if ($imgUploadError === UPLOAD_ERR_OK) {
    $fileExtension = pathinfo($_FILES['uploadPicture']['name'], PATHINFO_EXTENSION);
    $imgDestinationPath = "../uploads/{$username}.{$fileExtension}";
    move_uploaded_file($_FILES['uploadPicture']['tmp_name'], $imgDestinationPath);
} elseif ($imgUploadError !== UPLOAD_ERR_OK) {
    $errorCode = $_FILES['uploadPicture']['error'];
    $phpFileUploadErrors = [
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    ];
    if (isset($phpFileUploadErrors[$errorCode])) {
        $_SESSION['uploadPicture'] = $phpFileUploadErrors[$errorCode];
        exit();
    } else {
        $_SESSION['uploadPicture'] = "Unknown Error";
        exit();
    }
}


function postPicture($posterId, string $imgPath, string $title, string $text)
{

    require "connection.php";

    try {
        $prepareInsertComment = $pdoInsta->prepare("INSERT INTO pictures (picture_link, img_title, img_text, poster_id) VALUES (:picture_link, :img_title, :img_text, :poster_id)");
        $prepareInsertComment->execute([
            ':picture_link' => $imgPath,
            ':img_title' => $title,
            ':img_text' => $text,
            ':poster_id' => $posterId
        ]);
        echo json_encode("imgUploadSuccess");
        exit();
    } catch (PDOException $exception) {
        $_SESSION['lastErrMsg'] = $exception->getMessage();
        header('Location: ../index.php?err=postCommentFailed');
        exit();
    }
}
