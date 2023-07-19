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


foreach($fetchedPictures as $pic){
echo<<<HTML
    <article class="post">
    <header>
        <div class="title">
            <h2><a href="user_profile.php?id={$pic['id']}">{$pic['img_title']}</a></h2>
        </div>
        <div class="meta">
            <time class="published" datetime="2015-11-01">{$pic['timedate']}</time>
            <a href="user_profile.php?id={$pic['id']}" class="author"><span class="name">{$pic['username']}</span><img src="../{$pic['pfpLink']}" alt="" /></a>
        </div>
    </header>
    <a href="user_profile.php?id={$pic['id']}" class="image featured"><img src="{$pic['picture_link']}" alt="" /></a>
    <p>{$pic['img_text']}</p>
    <footer>
        <ul class="actions">
            <li><a href="commentaire.php" class="button large">Ajouter un commentaire</a></li>
        </ul>
        <ul class="stats">
            <li><a href="#">General</a></li>
            <li><a href="#" class="icon solid fa-heart" id="like{$pic['id']}">28</a></li>
            <li><a href="#" class="icon solid fa-comment">128</a></li>
        </ul>
    </footer>
</article>
HTML;
}

