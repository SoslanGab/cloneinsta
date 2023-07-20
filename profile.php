<?php
session_start();
if (!isset($_SESSION['idUser'])) {
	header('Location: index.php?err=userNotLoggedIn');
	exit();
}
?>
<?php include "header.php"; ?>

<body class="is-preload">
	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Main -->
		<div id="main">

			<!-- Post -->
			<?php
			include_once "actions/get-pictures.php";
			include_once "actions/get-likes.php";
			include_once "actions/get-comments.php";

			foreach ($fetchedPictures as $pic) {
				$style = 'style=""';
				$i = 0;
				foreach ($fetchedLikes as $values) {
					if ($values['picture_id'] === $pic['pic_id'] && $values['poster_id'] === $_SESSION['idUser']) {
						$style = 'style="color: red;"';
					}
					foreach ($values as $key => $value) {
						if ($key === 'picture_id' && $value === $pic['pic_id']) {
							$i++;
						}
					};
				};
				$c = 0;
				foreach ($fetchedComments as $comment) {
					if ($comment['picture_id'] == $pic['pic_id']) {
						$c++;
					}};
				echo <<<HTML
    <article class="post">
		<section class="section1">
			<div class="title">
				<h2><a href="user_profile.php?id={$pic['id']}">{$pic['img_title']}</a></h2>
			</div>
			<div class="meta">
				<time class="published" datetime="2015-11-01">{$pic['timedate']}</time>
				<a href="user_profile.php?id={$pic['id']}" class="author"><span class="name">{$pic['username']}</span><img src="../{$pic['pfpLink']}" alt="" /></a>
			</div>
		</section>
		<a href="user_profile.php?id={$pic['id']}" class="image featured"><img src="{$pic['picture_link']}" alt="" /></a>
		<p>{$pic['img_text']}</p>
		<section class="section2">
			<div class="actions mx-auto">
				<!-- Popup -->
				<button type="button" class="button large" data-toggle="modal" data-target="#exampleModal{$pic['pic_id']}" data-whatever="@getbootstrap">Ajouter un commentaire</button>

				<div class="modal fade" id="exampleModal{$pic['pic_id']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title mx-auto" id="exampleModalLabel">Ajouter un commentaire</h5>
							</div>
							<div class="modal-body">
								<form action="actions/post-comment.php" method="POST" enctype="multipart/form-data">
									<div class="form-group">
										<label for="message-text" class="col-form-label">Message:</label>
										<textarea class="form-control" id="message-text" name ="commentConent"></textarea>
										<input type="number" name="pictureId" value="{$pic['pic_id']}" hidden>
									</div>
								
							</div>
							<div class="modal-footer">
								<button type="button" class="button" data-dismiss="modal">Fermer</button>
								<button type="submit" class="button">Envoyer le commentaire</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<ul class="stats">
				<li><a href="#">General</a></li>
				<li><a class="icon solid fa-heart" id="like{$pic['pic_id']}" {$style}>{$i}</a></li>
				<li><a class="icon solid fa-comment" onclick="showCommentList({$pic['pic_id']})">{$c}</a></li>
			</ul>
		</section>
		<section class="show-comments mt-5" id="commentList{$pic['pic_id']}" hidden>
			<div class="container">
				<div class="row">
HTML;
				foreach ($fetchedComments as $comment) {
					if ($comment['picture_id'] == $pic['pic_id']) {
						echo <<<HTML
    <div class="comments col-12 border">
     <div class="pic-date">
    	<time class="published" datetime="2015-11-01">{$comment['timedate']}</time>
    	<a href="user_profile.php?id={$pic['id']}" class="author"><span class="name">{$comment['username']}</span><img src="../{$comment['pfpLink']}" alt="" /></a>
    </div>
    <div class="">
    	<p class="" name="" id="">{$comment['content']}</p>
    </div>
    </div>
HTML;
					};
				}
				echo <<<HTML
				</div>
			</div>
		</section>
</article>
HTML;
			}
			?>
		</div>


		<!-- Sidebar -->
		<section id="sidebar">
			<!-- Posts List -->
			<section>
				<ul class="posts">
					<li>
						<article>
							<header>
								<h3><a href="single.html">Lorem ipsum fermentum ut nisl vitae</a></h3>
								<time class="published" datetime="2015-10-20">October 20, 2015</time>
							</header>
							<a href="single.html" class="image"><img src="images/pic08.jpg" alt="" /></a>
						</article>
					</li>
				</ul>
			</section>

			<!-- About -->
			<section class="blurb">
				<h2>A PROPOS DE ALIGRAM</h2>
				<p>Aligram est un clone de instagram crée en 2023 par deux migrant issu des pays de l'est, conçus pour que les gens puissent s'exrpimé librement</p>
			</section>

			<?php include "footer.php"; ?>

		</section>

	</div>