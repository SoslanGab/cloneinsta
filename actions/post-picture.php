<?php

session_start();


$title = $_POST['title'];
$text = $_POST['text'];
$posterId = $_SESSION['idUser'];
$username = $_SESSION['username'];
$uniqueKey = random_int(1, 999);
$imgUploadError = $_FILES['uploadPicture']['error'];
$lastPost = date("Y-m-d H:i:s");


if ($imgUploadError === UPLOAD_ERR_OK) {
    $fileExtension = pathinfo($_FILES['uploadPicture']['name'], PATHINFO_EXTENSION);
    $imgDestinationPath = "../uploads/{$username}{$uniqueKey}.{$fileExtension}";
    $imgPath = "uploads/{$username}{$uniqueKey}.{$fileExtension}";
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


function postPicture($posterId, $lastPost, string $imgPath, string $title, string $text)
{

    require "connection.php";

    try {
        $prepareInsertPicture = $pdoInsta->prepare("INSERT INTO pictures (picture_link, img_title, img_text, poster_id) VALUES (:picture_link, :img_title, :img_text, :poster_id)");
        $prepareInsertPicture->execute([
            ':picture_link' => $imgPath,
            ':img_title' => $title,
            ':img_text' => $text,
            ':poster_id' => $posterId
        ]);

    } catch (PDOException $exception) {
        $_SESSION['lastErrMsg'] = $exception->getMessage();
        header('Location: ../profile.php?err=postPictureFailed');
        exit();
    }

    try {
        $prepareInsertLastPictureUpdate = $pdoInsta->prepare("UPDATE users SET last_post = :last_post WHERE id = :id");
        $prepareInsertLastPictureUpdate->execute([
            ':last_post' => $lastPost,
            ':id' => $posterId
        ]);
        header('Location: ../profile.php?info=pictureUploadSuccess');
        exit();
    } catch (PDOException $exception) {
        $_SESSION['lastErrMsg'] = $exception->getMessage();
        header('Location: ../profile.php?err=insertLastPictureUpdateFailed');
        exit();
    }
}


postPicture($posterId, $lastPost, $imgPath, $title, $text);