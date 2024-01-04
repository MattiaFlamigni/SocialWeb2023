<div class="sticky-top py-1 mx-auto mb-3 text-center bg-body-tertiary border border-2 rounded-bottom border-top-0" style="max-width: 52em;">
	<h1> Post a cui hai messo Mi Piace </h1>
</div>

<?php
// this exposes the $dbh variable (object of DatabaseHelper), check the DatabaseHelper class in db/database.php for more info
require_once 'bootstrap.php';

require_once 'util/images.php';

$posts = $dbh->fetchLikedPosts($_COOKIE['user']);
foreach ($posts as $post) {
	echo <<<EOS
	<div class="d-flex justify-content-center my-4">
		<div class="card" style="max-width: 50em;">
			<img src="$post->url" class="card-img-top" alt="...">
			<div class="card-body container">
				<div class="row">
					<div class="col me-3" style="max-width: 4em;">
						<img src="$post->user_picture" class="rounded-circle object-fit-cover" style="float: left; width: 4em; height: 4em;">
					</div>
					<div class="col">
						<h5 class="card-title">@$post->user</h5>
					<p class="card-text">$post->description</p>
					<!-- TODO: add date -->
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
