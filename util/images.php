<?php
$imgdir = '' // TODO

function image_url($id) {
	$filedir = $imgdir . "$id.png"
	// TODO: do not use full paths as it may expose sensitive data
	return $filedir
}
?>