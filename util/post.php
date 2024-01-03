<?php

$imgdir = ''; // TODO

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

	if ($imageSize === false) {
		return 'l\'immagine non può essere letta, probabilmete è corrotta';
	}
	if (in_array($imageSize['mime'], $allowedTypes)) {
		return 'il formato dell\'immagine caricata non è ammesso, sono ammessi solo PNG e JPEG';
	}
	if ($imageSize[0] >= $minSize && $imageSize[0] <= $maxSize &&
	$imageSize[1] >= $minSize && $imageSize[1] <= $maxSize) {
		return 'l\'immagine è troppo grande o troppo piccola, le dimensioni ammesse per le immagini vanno da ' . $minSize . 'x' . $minSize . ' a ' . $maxSize . 'x' . $maxSize;
	}

	return '';
}

function post_desc_error() {
	if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['desc'])) {
		return 'la descrizione non è stata ricevuta';
	}

	$desc = $_POST['desc'];
	$maxChar = 2000;

	if (strlen($desc) > $maxChar) {
		return 'la descrizione è troppo lunga, può contenere al massimo ' . $maxChar . ' caratteri';
	}

	return '';
}

// validate form at post creation
// empty string means ok, otherwise the string contains the error
function post_form_error() {
	$imageValidity = post_image_error();
	$descriptionValidity = post_desc_error();

	if (empty($imageValidity) && empty($descriptionValidity)) {
		return '';
	} else {
		$error = '<ul>';
		if (!empty($imageValidity)) {
			$error .= '<li>' . $imageValidity . '</li>';
		}
		if (!empty($descriptionValidity)) {
			$error .= '<li>' . $descriptionValidity . '</li>';
		}
		$error .= '</ul>';
		return $error;
	}
}

function new_image_id() {
	global $imgdir;
	$files = scandir($imgdir);
	for ($i = 0; $i < count($files); $i++) {
		// remove file extensions
		$files[$i] = preg_replace('\\..+$', '', $files[$i]);
	}
	$newID = '000000';
	while (in_array($newID, $files)) {
		// increment ID
		$newID = (string) (((int) $newID) + 1);
	}

	return $newID;
}

// $ext can be 'png', 'jpeg', etc.
function upload_image($id, $ext, $bytes) {
	global $imgdir;
	$newImage = fopen("$id.$ext", "w");
	fwrite($newImage, $bytes);
	fclose($newImage);
}

function image_url($id) {
	global $imgdir;
	$filedir = $imgdir . "$id.png";
	// TODO: do not use full paths as it may expose sensitive data
	return $filedir;
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