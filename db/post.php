<?php
$imgdir = ''; // TODO

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
