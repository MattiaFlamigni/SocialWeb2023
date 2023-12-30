<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<title>I tuoi Mi Piace</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iK16H3StjBvfxqSBXAm12XtwW1l75Vg5WBE5iP5S62XVtFkF+bpXQtXWo" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3e59e20392.js" crossorigin="anonymous"></script>
</head>

<body>
	<div class="sticky-top py-1 mx-auto mb-3 text-center bg-body-tertiary border border-2 rounded-bottom border-top-0" style="max-width: 52em;">
		<h1> Post a cui hai messo Mi Piace </h1>
	</div>

<?php
// this exposes the $dbh variable (object of DatabaseHelper), check the DatabaseHelper class in db/database.php for more info
require_once 'bootstrap.php';

require_once 'util/images.php';

$posts = $dbh->fetchLikedPosts($_COOKIE['user']);
foreach ($posts as $post) {
	$imgpath = image_path($post->image_id)
	$propic = image_path($post->profile_image_id)
	echo <<<EOS
	<div class="d-flex justify-content-center my-4">
		<div class="card" style="max-width: 50em;">
			<img src="$imgpath" class="card-img-top" alt="...">
			<div class="card-body container">
				<div class="row">
					<div class="col me-3" style="max-width: 4em;">
						<img src="$propic" class="rounded-circle object-fit-cover" style="float: left; width: 4em; height: 4em;">
					</div>
					<div class="col">
						<h5 class="card-title">@$post->username</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	EOS;
}

?>
<!--
	<div class="d-flex justify-content-center my-4">
		<div class="card" style="max-width: 50em;">
			<img src="img/amsterdam.jpeg" class="card-img-top" alt="...">
			<div class="card-body container">
				<div class="row">
					<div class="col me-3" style="max-width: 4em;">
						<img src="img/user.jpg" class="rounded-circle object-fit-cover" style="float: left; width: 4em; height: 4em;">
					</div>
					<div class="col">
						<h5 class="card-title">@[nome utente]</h5>
					<p class="card-text">[descrizione del post]</p>
					<a href="#" class="btn btn-primary">Vai al post</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="d-flex justify-content-center my-4">
		<div class="card" style="max-width: 50em;">
			<img src="img/amsterdam.jpeg" class="card-img-top" alt="...">
			<div class="card-body container">
				<div class="row">
					<div class="col me-3" style="max-width: 4em;">
						<img src="img/user.jpg" class="rounded-circle object-fit-cover" style="float: left; width: 4em; height: 4em;">
					</div>
					<div class="col">
						<h5 class="card-title">@[nome utente]</h5>
					<p class="card-text">[descrizione del post]</p>
					<a href="#" class="btn btn-primary">Vai al post</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="d-flex justify-content-center text-center">
		<div class="container-fluid mt-3">
			<div class="rounded-top border bg-body-tertiary col-12 col-md-7 mx-auto">
				<img src="img/user.jpg" class="rounded-circle " alt="utente" width="50" height="50"> Username
			</div>
			<div class="">
				<div class="">
					<img src="img/amsterdam.jpeg" class="img-fluid rounded-bottom col-md-7 " alt="">
				</div>
			</div>
		</div>
	</section>
	<section class="d-flex justify-content-center text-center">
		<div class="container-fluid mt-3">
			<div class="rounded-top border bg-body-tertiary col-12 col-md-7 mx-auto">
				<img src="img/user.jpg" class="rounded-circle " alt="utente" width="50" height="50"> Username
			</div>
			<div class="">
				<div class="">
					<img src="img/amsterdam.jpeg" class="img-fluid rounded-bottom col-md-7 " alt="">
				</div>
			</div>
		</div>
	</section>
-->

	<footer class="w-100 text-center mt-5 pt-5">
		<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-expand fixed-bottom ">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav mx-auto">
						<a class="nav-link" aria-current="page" href="mainFeed.html"><i class="fa-solid fa-house"></i></a>
						<a class="nav-link" aria-current="page" href="likes.html"><i class="fa-solid fa-heart px-5"></i></a>
						<a class="nav-link" aria-current="page" href="createPost.html"><i class="fa-solid fa-plus fs-4"></i></a>
						<a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-envelope px-5"></i></a>
						<a class="nav-link" aria-current="page" href="profile.html"><i class="fas fa-user "></i></a>
					</div>
				</div>
			</div>
		</nav>
	</footer>
</body>
</html>
