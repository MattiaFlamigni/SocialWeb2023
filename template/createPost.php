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
require_once 'util/post.php';

if (!empty($_FILES["image"])) {
	$error = post_form_error();
	if (empty($error)) {
		$id = new_image_id();
		$ext = preg_replace('/^.+\\./', '', $_FILES['image']['name']);
		$fileContent = file_get_contents($_FILES['image']['tmp_name']);

		upload_image($id, $ext, $fileContent);
		$dbh->uploadPost($id, $_POST['desc'], date('Y-m-d'), $_COOKIE['user']);
		echo '<p>Il tuo post sarà visibile tra un attimo, ora puoi chiudere questa pagina.</p>';
	} else {
		echo '<p>Si sono verificati uno o più errori elencati di seguito:</p>';
		echo $error;
	}
}
?>
	</div>
</div>

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
