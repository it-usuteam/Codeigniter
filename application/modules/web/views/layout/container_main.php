<!DOCTYPE html>
<html>
<head>
	<title><?php echo isset($title) ? $title.' - ' : '' ?><?php echo TI_USU_TITLE ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"> -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style>
		* {
			transition: all 0.5 ease;
		}
    html, body {
      width:100%;
      height: 100%;
    }
		body div:first-of-type {
			min-height: calc(100% - 3.5em);
		}
		.menu-fix {
			width: 100%;
			position: fixed;
			top: 0;
			left: 0;
			background: #EEE;
			z-index: 2;
		}
		.menu-fix .menu-item {
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
		.top-section {
			padding-top: 5em;
			padding-bottom: 3em;
			background: #34803D;
			color: #FFF;
		}
		.top-section div:first-child {
			vertical-align: middle;
		}
		.top-section .logo {
			margin: 0 auto;
		}
		.top-section .title, .top-section .subtitle {
			text-transform: uppercase;
			font-weight: 700;
		}
		@media (max-width: 767px) {
			.top-section .title, .top-section .subtitle {
				text-align: center;
			}
		}
		footer {
			text-align: center;
			padding: 1em;
			background: #EEE;
			color: #333;
		}
		@media (min-width: 768px) {
			.col-sm-inline {
				display: inline-block;
				float: none;
				margin: 0 0 0 -1em;
			}
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<!-- Header teratas, fixed -->
		<div class="menu-decoy"></div>
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
    <!-- Please insert things row by row -->

		<div class="row top-section">
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-sm-inline">
						<img class="img-responsive logo" src="<?php echo base_url() ?>/resources/img/logo.png">
					</div>
					<div class="col-sm-8 col-sm-inline" style="transform: translateY(25%); ">
						<h1 class="title">Teknologi Informasi</h1>
						<h3 class="subtitle">Universitas Sumatera Utara</h3>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="container">
				<?php echo $content ?>
			</div>
		</div>
	</div>
	<footer>
		 &copy; <?php echo date('Y') ?> <?php echo TI_USU_TITLE ?>
	</footer>
</body>
</html>
