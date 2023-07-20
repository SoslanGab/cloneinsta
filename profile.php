<!DOCTYPE HTML>
<html>

<head>
	<title>CloneInstagram</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
</head>

<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">
		<?php include "header.php"; ?>

		<!-- Main -->
		<div id="main">

			<!-- Post -->
			<?php
			include_once "actions/get-pictures.php";

			foreach ($fetchedPictures as $pic) {
				echo <<<HTML
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
            <li><a href="#" class="icon solid fa-heart" id="like{$pic['pic_id']}" onclick="likePost({$pic['pic_id']})">28</a></li>
            <li><a href="#" class="icon solid fa-comment">128</a></li>
        </ul>
    </footer>
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


</body>
	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/profile_custom_js.js"></script>
</html>