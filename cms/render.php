<?php
	require "./gemtext.php";

	// get the body content
	$_src = null;
	$path = null;
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$_src = fopen("php://input", "r");
		$path = $_SERVER['PATH_INFO'];
	} else {
		$path = $_SERVER['REDIRECT_URL'];
		$_src = fopen("..".$path, "r") or die("File not found: ".$path);
		header("Last-Modified: ".date("r", filemtime("..".$path)));
	}
	
	$_content = gemtext_to_html($_src);
	fclose($_src);

	// pull out variables for convenience
	$title = $_content['title'];
	$body = $_content['body'];
	
	include "../theme/layout.php";
?>
