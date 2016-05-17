<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Error</title>
<style type="text/css">
	@import url(https://fonts.googleapis.com/css?family=Oxygen:400,700,300);
	* {
		transition: all 1s ease;
	}
	html {
		background: #F6F6F6;
	}
	html, body {
		height: 100%;
		width: 100%;
		padding: 0;
		margin: 0;
		font-family: 'Oxygen';
	}
	.container {
		text-align: center;
		padding: 1em;
	}
	.img {
		height: 50vmin;
		margin: 0 auto;
		padding: 1em;
	}
	.container h1 {font-size: 5vmin;}
	.container .message { font-size: 3vmin; }
	@media (min-height: 400px) {
		.container {
			top: 50%;
			left: 50%;
			position: absolute;
			transform: translate(-50%, -50%);
		}
	}
</style>
</head>
<body>
	<div class="container">
		<!-- Manual image insertion, 404 called before controller initialized or what -->
		<!-- TODO Dynamic url for this image -->
		<img class="img" src="http://localhost/CI/resources/img/<?php echo http_response_code() ?>.png">
		<h1><?php echo $heading; ?></h1>
		<span class='message'><?php echo $message; ?></span>
	</div>
</body>
</html>
