<?php
session_start();
if (!isset($_SESSION['idUser'])) {
	header('Location: index.php?err=userNotLoggedIn');
	exit();
}

if (isset($_GET['id'])) {
	$currentUser = $_GET['id'];
} else {
	$currentUser = $_SESSION['idUser'];
}

include_once "actions/get-users.php";
include_once "actions/get-pictures.php";

$users = [];
foreach($fetchedUsers as $user){
	$id = $user['id'];
	$users[$id] = $user;
}

?>
<!-- Header -->
<?php include "header.php"; ?>

<body class="single is-preload">

	<!-- Wrapper -->
	<div id="wrapper">


		<!-- Main -->
		<div id="main">
			<!-- Post -->
			<article class="post">
				<header>
					<div class="title">
						<h2><a href="user_profile.php?id=<?=$users[$currentUser]['id']?>"><?=$users[$currentUser]['username']?></a></h2>
					</div>
					<div class="meta">
						<a href="user_profile.php?id=<?=$users[$currentUser]['id']?>" class="author"><span class="name"><?=$users[$currentUser]['username']?> </span><img src="<?=$users[$currentUser]['pfpLink']?>" alt="" /></a>
					</div>
				</header>
				<?php
foreach($fetchedPictures as $picture){
	if($picture['poster_id'] == $currentUser){
echo <<<HTML
				<div class="card" style="width: 25rem;">
					<div class="card">
						<img style="height: 20rem;" class="" src="{$picture['picture_link']}">
					</div>
				</div>
HTML;
}
}
				?>
			</article>
		</div>
		<!-- Footer -->
		<?php include 'footer.php'; ?>

	</div>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>

</html>