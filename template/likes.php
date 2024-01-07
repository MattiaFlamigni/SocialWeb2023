<?php
// this exposes the $dbh variable (object of DatabaseHelper), check the DatabaseHelper class in db/database.php for more info
require_once 'bootstrap.php';

require_once 'util/post.php';

$posts = $dbh->fetchLikedPosts($_COOKIE['user']);
foreach ($posts as $post) {
	echo <<<EOS
	<div class="d-flex justify-content-center my-4">
		<div class="card" style="max-width: 50em;">
			<img src="$post->url" class="card-img-top" alt="">
			<div class="card-body container">
				<div class="row">
					<div class="col me-3" style="max-width: 4em;">
						<img src="$post->user_picture" class="rounded-circle object-fit-cover" style="float: left; width: 4em; height: 4em;" alt="">
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