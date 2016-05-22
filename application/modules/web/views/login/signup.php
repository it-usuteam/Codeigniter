<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo (isset($title) ? $title.' - ' : '').TI_USU_TITLE ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"> -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
  <style>
    body {
      background: #EEE;
    }
    .form-container {
      padding: 1em;
      margin-top: 15vh;
      background: #FFF;
      text-align: center;
    }
    .form-object {
        display: block;
        width: 100%;
        border: 0;
        padding: 0.5em;
        margin: 1em auto;
        background: #EEE;
    }
    button.form-object {
      color: #333;
    }
    .form-container .divider {
      width: 100%;
      height: 0.25em;
      margin: 0 auto;
      border-top: 0.1em solid #AAA;
      border-bottom: 0.1em solid #AAA;
    }
    .logo {
      max-height: 30vmin;
      max-width: 100%;
      margin: -15vmin auto 0 auto;
    }
    footer {
      padding: 1em;
      font-style: italic;
    }
    @media (min-width: 768px) {
      .form-container .col-inline:first-child {
        /*border-right: 0.1em solid #AAA;*/
      }
      .form-container .col-inline {
        /*display: inline-block;
        float: none;*/
        padding: 0;
        margin-right: -4px;
        vertical-align: middle;
      }
      .form-container .divider {
        width: 0.45em;
        height: 22em;
        border: 0;
        transform: translateX(-50%);
        border-left: 0.2em solid #AAA;
        border-right: 0.2em solid #AAA;
      }
    }
  </style>
  <div class="container">
    <div class="container-fluid col-sm-8 col-sm-offset-2 form-container">
      <div class="row">
        <div class="col-xs-12 text-center">
          <img class="img-responsive logo" src="<?php echo base_url() ?>/resources/img/logo.png">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-inline">
          <h1>Log In</h1>
          <div class="container-fluid">
            <div class="col-md-12">
              <?php
                echo form_open('web/login/process');
                echo form_input([
                  'name' => 'username',
                  'id'   => 'field_username',
                  'class' => 'form-object',
                  'placeholder' => 'Username',
                  'maxLength' => 30,
                  'required' => '',
                ]);
                echo form_password([
                  'name' => 'password',
                  'id'   => 'field_password',
                  'class' => 'form-object',
                  'placeholder' => 'Password',
                  'pattern' => '.{7,}',
                  'required' => '',
                ]);
                echo form_submit([
                  'name' => 'submit',
                  'id' => 'field_submit',
                  'class' => 'form-object',
                  'value' => 'Sign Up',
                  'style' => 'background: #73DE73; color: #FFF;',
                ]);
                echo form_close();
              ?>
            </div>
          </div>
        </div>
        <!-- <div class="col-sm-2 col-inline">
          <div class="divider"></div>
        </div> -->
        <div class="col-sm-6 col-inline">
          <h1>Sign Up</h1>
          <div class="container-fluid">
            <div class="col-md-12">
              <?php
                echo form_open('web/login/signup_login');
                echo form_input([
                  'name' => 'username',
                  'id'   => 'field_username',
                  'class' => 'form-object',
                  'placeholder' => 'Username',
                  'maxLength' => 30,
                  'required' => '',
                  'value' => isset($data) ? $data->username : '',
                ]);
                echo form_input([
                  'name' => 'fullname',
                  'id'   => 'field_fullname',
                  'class' => 'form-object',
                  'placeholder' => 'Fullname',
                  'required' => '',
                  'value' => isset($data) ? $data->fullname : '',
                ]);
                echo form_input([
                  'name' => 'email',
                  'id'   => 'field_email',
                  'type' => 'email',
                  'class' => 'form-object',
                  'placeholder' => 'E-Mail',
                  'required' => '',
                  'value' => isset($data) ? $data->email : '',
                ]);
                echo form_password([
                  'name' => 'password',
                  'id'   => 'field_password',
                  'class' => 'form-object',
                  'placeholder' => 'Password',
                  'pattern' => '.{7,}',
                  'required' => '',
                ]);
                echo form_submit([
                  'name' => 'submit',
                  'id' => 'field_submit',
                  'class' => 'form-object',
                  'value' => 'Sign Up',
                  'style' => 'background: #73DE73; color: #FFF;',
                ]);
                echo form_close();
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="container text-center">
    Teknologi Informasi Universitas Sumatera Utara <?php echo date('Y'); ?>
  </footer>
</body>
</html>
