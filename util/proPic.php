<?php


// The destination directory of uploaded images is defined in bootstrap.php as PIC_DIR

function post_image_error() {
	if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['image'])) {
		return 'l\'immagine non è stata ricevuta';
	}

	$image = $_FILES['image'];

	if ($image['error'] != UPLOAD_ERR_OK) {
		return 'si è verificato un errore durante il trasferimento dell\'immagine';
	}

	$allowedTypes = ['image/jpeg', 'image/png'];
	$minSize = 200;
	$maxSize = 3000;
	$imageSize = getimagesize($image['tmp_name']);
	$mimeType = mime_content_type($image['tmp_name']);

	if ($mimeType === false || !in_array($mimeType, $allowedTypes)) {
		return "il formato dell'immagine caricata ($mimeType) non è ammesso, sono ammessi solo PNG (image/png) e JPEG/JPG (image/jpeg)";
	}
	if ($imageSize === false) {
		return 'le dimensioni dell\'immagine non possono essere lette, potrebbe essere corrotta';
	}
	if ($imageSize[0] < $minSize || $imageSize[0] > $maxSize ||
	$imageSize[1] < $minSize || $imageSize[1] > $maxSize) {
		return "l'immagine è troppo grande o troppo piccola ($imageSize[0]x$imageSize[1]), le dimensioni ammesse per le immagini vanno da $minSize" . 'x' . "$minSize a $maxSize" . 'x' . "$maxSize";
	}

	return '';
}


// validate form at post creation
// empty string means ok, otherwise the string contains the error
function post_form_error() {
	$imageValidity = post_image_error();
	

	if (empty($imageValidity)) {
		return '';
	} else {
		$error = '<ul>';
		if (!empty($imageValidity)) {
			$error .= '<li>' . $imageValidity . '</li>';
		}
		$error .= '</ul>';
		return $error;
	}
}

function new_image_id() {
	$files = scandir(PIC_DIR);
	for ($i = 0; $i < count($files); $i++) {
		// remove file extensions
		$files[$i] = preg_replace('/\\..+$/', '', $files[$i]);
	}
	$newID = '0';
	while (in_array($newID, $files)) {
		// increment ID
		$newID = (string) (((int) $newID) + 1);
	}

	return $newID;
}

// $ext can be 'png', 'jpeg', etc.
function upload_image($id, $ext, $bytes) {
	$newImage = fopen(PIC_DIR . "/$id.$ext", "w");
	fwrite($newImage, $bytes);
	fclose($newImage);
}

function propic_url($id) {
	return glob(PIC_DIR . "/$id.*")[0];
}

class Post {
	public $url; // post image URL
	public $user;
	public $user_picture; // URL to user's profile picture
	public $description;
	public $date;

	public function __construct($url, $user, $user_pic, $description, $date) {
		$this->url = $url;
		$this->user = $user;
		$this->user_picture = $user_pic;
		$this->description = $description;
		$this->date = $date;
	}
}
?>
