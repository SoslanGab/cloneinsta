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


	<!-- Wrapper -->
	<div id="wrapper">
		<!-- Main -->
		<div id="main">
			<!-- Post -->
			<article class="post">
				<section1>
					<div class="title">
						<h2><a href="user_profile.php?id=<?=$users[$currentUser]['id']?>"><?=$users[$currentUser]['username']?></a></h2>
					</div>
					<div class="meta">
						<a href="user_profile.php?id=<?=$users[$currentUser]['id']?>" class="author"><span class="name"><?=$users[$currentUser]['username']?> </span><img src="<?=$users[$currentUser]['pfpLink']?>" alt="" /></a>
					</div>
				</section1>
			<div class="container">
				<div class="row">
				<?php
foreach($fetchedPictures as $picture){
	if($picture['poster_id'] == $currentUser){
echo <<<HTML
			
					<div class="col-4">
						<div class="card-profile">
							<img class="" src="{$picture['picture_link']}" alt="Description de l'image">
						</div>
					</div>
HTML;
}
}

				?>
				</div>
			</div>
			</article>
		</div>
	</div>


	<!-- Footer -->
	<?php include "footer.php"; ?>
