<!DOCTYPE html>
<html>
<head>
	<title>Teknologi Informasi Universitas Sumatera Utara</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"> -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style>
		* {
			transition: all 0.5 ease;
		}
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
			position: relative;
		}
		.menu-fix .menu-item:hover { background: #FFF; }
		/* Fixed Navigation */
		.menu-box {
			background: #EEE;
			padding: 1em;
			position: absolute;
			transform: translateY(1em);
			right: 0;
			visibility: hidden;
		}
		#accountTab:hover #accountBox, #accountBox:hover, #accountBox:focus {
			visibility: visible;
		}
		#accountBox {
			min-width: 20vw;
			padding:0.5em;
		}
		#accountBox input, .loginbutton {
			width: 100%;
			padding: 0.5em;
			margin: 0.5em auto;
			box-shadow: none;
			display:block;
			border: 0.2em solid transparent;
			background: #FFF;
		}
		#accountBox input:focus {
			border: 0.2em solid #3BB0AA;
		}
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
	</style>
</head>
<body>
	<div class="container-fluid">
		<!-- Header teratas, fixed -->
		<div class="menu-fix">
			<div class="col-xs-12 text-right">
				<span class="menu-item" id="langTab">Bahasa <span class="glyphicon glyphicon-menu-down"></span></span>
				<span class="menu-item" id="accountTab">
					Akun <span class="glyphicon glyphicon-menu-down"></span>
					<div class="menu-box text-center" id="accountBox">
						<?php
							if(!isset($user) || is_null($user)) {
								echo form_open('web/login/process');
								echo form_input([
									'name' => 'username',
									'id'   => 'field_username',
									'placeholder' => 'Username',
									'maxLength' => '30',
									'required' => 'true',
								]);
								echo form_password([
									'name' => 'password',
									'id' => 'field_password',
									'placeholder' => 'Password',
									'maxLength' => '64',
									'required' => 'true',
								]);
								echo form_submit([
									'name' => 'login_submit',
									'class' => 'loginbutton',
									'value' => "Log In",
								]);
								echo form_button([
									'name' => 'signup_button',
									'content' => "Sign Up",
									'class' => 'loginbutton',
									'style' => "background-color: #5F94E3;color: #EEE;",
									'onClick' => "location.href = '".site_url('web/login/signup_login')."'",
								]);
								echo form_close();
							} else {
								// TODO Style this box.
								?>
						<h4><?php echo $user['fullname'] ?></h4>
						<h5><?php echo $user['username'] ?></h5>
						<a class="loginbutton" style="background: #EC3838; color: #FFF; " type=button href="<?php echo site_url("web/login/signout") ?>">Sign Out</a>
								<?php
							}
						?>
					</div>
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
	</div>
</body>
</html>
