<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="assets/css/main.css" />
	<title>Tasks BeeJee</title>
</head>
<body class="bg-light">
	<header class="header p-3  bg-secondary text-white">
		<div class="container clearfix">
			<a href="/" class=" text-white float-left"> Task manager</a>
			<a href="/authorization" type="button" class="btn btn-light float-right mx-1 btn-sm">Login</a>
			<a href="/add" type="button" class="btn btn-light float-right mx-1 btn-sm ">Add</a>
		</div>
	</header>
	<section class="main">
		<div class="container ">
			<?php include 'application/views/'.$content_view; ?>
		</div>
		
	</section>
	
	<footer class="footer p-3  bg-secondary text-white">
		<div class="container ">
			<span>
			Victor Titov created December 2019
			</span>
		</div>
	</footer>
	<script id="__bs_script__">//<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.26.7'><\/script>".replace("HOST", location.hostname));
//]]></script>
</body>
</html>