<?php

class Post {
	public $url; // post image URL
	public $user;
	public $user_picture; // URL to user's profile picture
	public $description;
	public $date;

	public function __construct($url, $user, $user_pic, $description, $date) {
		$this->url = $url;
		$this->user = $user;
		$this->user_pic = $user_pic;
		$this->description = $description;
		$this->date = $date;
	}
}

?>
