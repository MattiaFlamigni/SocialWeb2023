<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<title>Crea un nuovo post</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iK16H3StjBvfxqSBXAm12XtwW1l75Vg5WBE5iP5S62XVtFkF+bpXQtXWo" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/3e59e20392.js" crossorigin="anonymous"></script>
</head>

<body>
	<div class="sticky-top py-1 mx-auto mb-3 text-center bg-body-tertiary border border-2 rounded-bottom border-top-0" style="max-width: 52em;">
		<h1> Crea un nuovo post </h1>
	</div>

	<div class="container">
		<div class="row">
			<div class="col mt-3">
				<form action="createPost.php" method="post" enctype="multipart/form-data">
					<label class="form-label" for="image"> Scegli un'immagine </label>
					<div class="input-group mb-3">
						<input type="file" class="form-control" name="image" id="image" accept="image/*">
					</div>
					<label class="form-label" for="desc"> Aggiungi una descrizione </label>
					<div class="input-group mb-3">
						<span class="input-group-text">✏️</span>
						<textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Carica</button>
				</form>
			</div>
			<div class="col mt-3">
				<p> Anteprima </p>
				<img id="preview" src="#" alt="La tua immagine" style="display: none; max-width: 50vw;">
				<p id="previewInfo" style="color: darkgray;"> Qui comparirà un'anteprima dell'immagine che vuoi caricare! </p>
			</div>
		</div>
		<div class="row">
<?php
require_once 'util/post.php';
require_once './bootstrap.php';
require_once 'db/post.php';

if (!empty($_POST)) {
	$error = post_form_error();
	if (empty($error)) {
		$dbh->uploadPost(new_image_id(), $_POST['desc'], date('d/m/Y, H:i'), $_COOKIE['user']);
		echo '<p>Il tuo post sarà visibile tra un attimo, puoi chiudere questa pagina.</p>';
	} else {
		echo '<p>Si sono verificati uno o più errori elencati di seguito:</p>';
		echo $error;
	}
}
?>
		</div>
	</div>

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

	<script>
	// preview image
	image.onchange = evt => {
		const file = image.files[0]
		let preview = document.getElementById("preview")
		let previewInfo = document.getElementById("previewInfo")
		if (file) {
			preview.src = URL.createObjectURL(file)
			previewInfo.style.display = "none"
			preview.style.display = "block"
		}
	}
	</script>
</body>
</html>
