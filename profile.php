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
        <div class="actions">
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
            <li><a href="#" class="icon solid fa-comment">128</a></li>
        </ul>
	</section>
</article>
HTML;
			}
			?>

			<!-- Pagination -->
			<ul class="actions pagination">
				<li><a href="" class="disabled button large previous">Previous Page</a></li>
				<li><a href="#" class="button large next">Next Page</a></li>
			</ul>

		</div>


		<!-- Sidebar -->
		<section id="sidebar">

			
			<!-- Mini Posts -->
			<section>
				<div class="mini-posts">

					<!-- Mini Post -->
					<article class="mini-post">
						<header>
							<h3><a href="single.html">Vitae sed condimentum</a></h3>
							<time class="published" datetime="2015-10-20">October 20, 2015</time>
							<a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
						</header>
						<a href="single.html" class="image"><img src="images/pic04.jpg" alt="" /></a>
					</article>

					<!-- Mini Post -->
					<article class="mini-post">
						<header>
							<h3><a href="single.html">Rutrum neque accumsan</a></h3>
							<time class="published" datetime="2015-10-19">October 19, 2015</time>
							<a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
						</header>
						<a href="single.html" class="image"><img src="images/pic05.jpg" alt="" /></a>
					</article>

					<!-- Mini Post -->
					<article class="mini-post">
						<header>
							<h3><a href="single.html">Odio congue mattis</a></h3>
							<time class="published" datetime="2015-10-18">October 18, 2015</time>
							<a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
						</header>
						<a href="single.html" class="image"><img src="images/pic06.jpg" alt="" /></a>
					</article>

					<!-- Mini Post -->
					<article class="mini-post">
						<header>
							<h3><a href="single.html">Enim nisl veroeros</a></h3>
							<time class="published" datetime="2015-10-17">October 17, 2015</time>
							<a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
						</header>
						<a href="single.html" class="image"><img src="images/pic07.jpg" alt="" /></a>
					</article>

				</div>
			</section>

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
					<li>
						<article>
							<header>
								<h3><a href="single.html">Convallis maximus nisl mattis nunc id lorem</a></h3>
								<time class="published" datetime="2015-10-15">October 15, 2015</time>
							</header>
							<a href="single.html" class="image"><img src="images/pic09.jpg" alt="" /></a>
						</article>
					</li>
					<li>
						<article>
							<header>
								<h3><a href="single.html">Euismod amet placerat vivamus porttitor</a></h3>
								<time class="published" datetime="2015-10-10">October 10, 2015</time>
							</header>
							<a href="single.html" class="image"><img src="images/pic10.jpg" alt="" /></a>
						</article>
					</li>
					<li>
						<article>
							<header>
								<h3><a href="single.html">Magna enim accumsan tortor cursus ultricies</a></h3>
								<time class="published" datetime="2015-10-08">October 8, 2015</time>
							</header>
							<a href="single.html" class="image"><img src="images/pic11.jpg" alt="" /></a>
						</article>
					</li>
					<li>
						<article>
							<header>
								<h3><a href="single.html">Congue ullam corper lorem ipsum dolor</a></h3>
								<time class="published" datetime="2015-10-06">October 7, 2015</time>
							</header>
							<a href="single.html" class="image"><img src="images/pic12.jpg" alt="" /></a>
						</article>
					</li>
				</ul>
			</section>

			<!-- About -->
			<section class="blurb">
				<h2>About</h2>
				<p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod amet placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at phasellus sed ultricies.</p>
				<ul class="actions">
					<li><a href="#" class="button">Learn More</a></li>
				</ul>
			</section>

			<?php include "footer.php"; ?>

		</section>

	</div>
