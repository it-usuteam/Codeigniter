<!DOCTYPE html>
<html>
<head>
	<title>Teknologi Informasi Universitas Sumatera Utara</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"> -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style>
		.menu-fix {
			width: 100%;
			position: fixed;
			top: 0;
			left: 0;
			background: #EEE;
			z-index: 2;
		}
		.menu-fix .menu-item, .welcome-message {
			display: inline-block;
			padding: 1em;
		}
		.menu-fix .menu-item:hover { background: #FFF; }
		.search-input-container {
			display: inline-block;
			padding-left: 1em;
			background: #3BB0AA;
			color: #FFF;
			position: relative;
			min-width: 25%;
		}
		.search-input-container:before {
			content: "\e003";
			font-family: 'Glyphicons Halflings';
			display: inline-block;
			padding-top:0.5em;
			padding-left:0.5em;
			vertical-align: top;
			position: absolute;
			top: 0;
			left: 0;
		}
		.search-input {
			padding: 0.5em 0.5em 0.5em 1em;
			border: 0;
			background: transparent;
			color: #FFF;
			width: 100%;
		}
		.navigation-row { }
		.navigation-row ul {
			display: block;
			background : #3BB0AA; 
			padding: 0;
			margin: 0;
			list-style-type: none;
			width: 100%;
		}
		.navigation-row ul a {
			display: inline-block;
			padding: 1em;
			color: #FFF;
			font-size: 1.2em;
		}
		.navigation-row .current-page { background: #3C3E3D; position: relative; }
		.navigation-row .current-page:before {
			content: "";
			float:left;
			margin-top: -1.5em;
			margin-right: 2em;
			margin-left: -1em;
			display: block;
			height: 1em;
			padding: 1em;
			width: calc(100% + 2em);
			background: #3C3E3D;
		}
		/*
		.navigation-row .current-page:after {
			content:"\25BC";
			display: block;
			width: 100%;
			color: #3C3E3D;
			position: absolute;
			top: 100%;
			left: -0.15em;
			line-height: 0;
			font-size: 9vw;
		}
		*/
		.navigation-row ul a .nav-icon { font-size: 1.5em; display: block; }
	</style>
</head>
<body>
	<div class="container-fluid">
		<!-- Header teratas, fixed -->
		<div class="menu-fix">
			<div class="col-xs-12 text-right">
				<span class="menu-item">Bahasa <span class="glyphicon glyphicon-menu-down"></span></span>
				<span class="menu-item">Akun <span class="glyphicon glyphicon-menu-down"></span></span>
			</div>
		</div>
		
		<!-- Header awal -->
		<div class="row" style="padding-top:4em; padding-bottom: 2em; ">
			<div class="col-md-12 text-center">
				<form method="POST" action="?" class="search-input-container">
					<input type="text" placeholder="Cari...." class="search-input">
				</form>
			</div>
		</div>
		
		<!-- Navigasi -->
		<div class="row navigation-row">
			<ul class="text-center">
				<a href="#" class="current-page"><li>
					<div class="nav-icon"><span class="glyphicon glyphicon-home"></span></div>
					Home
				</li></a>
				<a href="#"><li>
					<div class="nav-icon"><span class="glyphicon glyphicon-certificate"></span></div>
					Profil
				</li></a>
				<a href="#"><li>
					<div class="nav-icon"><span class="glyphicon glyphicon-calendar"></span></div>
					Events
				</li></a>
				<a href="#"><li>
					<div class="nav-icon"><span class="glyphicon glyphicon-credit-card"></span></div>
					Berita
				</li></a>
			</ul>
		</div>
	</div>
</body>
</html>