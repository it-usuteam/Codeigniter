<!DOCTYPE HTML>
<?php
   if(!isset($title)) {
        $title = "";
   } else
        $title = $title.' - ';
?>
<html>
<head>
     <title><?php echo $title.TI_USU_ADMIN_TITLE ?></title>

     <!-- Meta dan kawan-kawan coming-soon, belum penting -->
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <link href='<?php echo site_url() ?>/resources/framework/bootstrap-3.3.5-dist/css/bootstrap.min.css' rel='stylesheet'>
     <link href='<?php echo site_url() ?>/resources/framework/bootstrap-3.3.5-dist/css/bootstrap-theme.css' rel='stylesheet'>

     <script src='<?php echo site_url() ?>/resources/framework/jquery/jquery-2.1.4.min.js'></script>
     <script src='<?php echo site_url() ?>/resources/framework/bootstrap-3.3.5-dist/js/bootstrap.js'></script>

</head>
<body>
     <style>
          @import url(https://fonts.googleapis.com/css?family=Oxygen:400,700,300);
          html {
               padding: 0;
               margin: 0;
               height: 100%;
               width:100%;
          }
          body {
               font-family: 'Oxygen';
               width: 90%;
               height: 100%;
               margin: 0 auto;
               background: #F0F0F0;
          }
          /* Common CSS */
          a {
               text-decoration: none;
               color: #333;
          }
          .page-tabs a, .box-style a {
               text-decoration: none;
               color: #555;
          }
          a:hover, a:focus, a:target {
               text-decoration: none;
          }
          /* End of Common CSS */
          .background {
               height: 100%;
               width:100%;
               right: 0;
               bottom: 0;
               transform: translate(50%, 50%);
               margin:0;
               position:fixed;
               z-index: -1;
               background-image: url('<?php echo site_url() ?>/resources/img/logo_big.png');
               filter: grayscale(30%);
               background-size: contain;
               background-position: center center;
               background-repeat: no-repeat;
               filter: grayscale(70%) opacity(50%);
          }
          .content {
               margin-top: 75px;
               color: #333;
               min-height: calc(100% - 160px);
          }
          footer {
               max-height:100px;
               padding: 1em;
               width: 100%;
               font-style: italic;
               font-size: 0.8em;
          }
          footer, footer a {
               color: #333;
          }
          .vcenter { /* Untuk col-*-* */
               display: inline-block;
               vertical-align: middle;
               float: none;
          }
          .box-style {
               background: #F8F8F8;
               /* border-radius: 0.5em; */
               color: #555;
               padding: 0.8em;
               margin-right: 10px;
               margin-bottom: 10px;
          }
          .box-style.col-md-12 {
               margin-right: auto;
          }
          .pagination a {
               border-radius: 0 !important;
          }
          .pagination .active a {
               background-color: #868686;
               border-color: #868686;
          }
          @media (max-width: 992px) {
               .tooltip-md .tooltip-inner {
                    display: none;
               }
          }
          .content a > .glyphicon {
               color: #333;
          }
     </style>
     <script>
          $(document).ready(function() {
               $('a[data-toggle=tooltip]').tooltip();

               $("#menuOpen").click( function() {
                    if($('.page-tabs').hasClass('active')) {
                         $('.page-tabs').removeClass('active');
                         setTimeout( function() {
                              $("#menuOpen").prependTo(".app-navbar .col-md-12");
                         }, 100);
                    }
                    else {
                         $('.page-tabs').addClass('active');
                         setTimeout( function() {
                              $("#menuOpen").prependTo(".page-tabs");
                         }, 200);
                    }
               });
          });
     </script>
     <div class="background"></div>
     <header>
          <style>
               header, header .page-tabs {
                    margin: 0;
                    padding: 0;
                    width: 100%;
                    position: fixed;
                    left: 0;
                    top: 0;
                    z-index: 2;
               }
               header .app-navbar {
                    background: #565656;
                    color: #EEE;
                    padding: 10px;
               }
               header .app-title {
                    font-size: 2em;
                    line-height: normal;
                    vertical-align: middle;
               }
               header .page-tabs {
                    overflow: auto;
                    height: 100%;
                    padding: 1em 2em;
                    background: #565656;
                    transform: translateX(-100%);
                    transition: transform 0.5s ease, width 0.5s ease;
               }
               header .page-tabs.active {
                    transform: translateX(0);
                    width: calc(100% + 15px);
                    padding-right: 15px;
               }
               header .app-navbar #menuOpen {
                    display: inline-block;
                    padding: 0;
                    margin-right: 10px;
                    line-height: normal;
                    vertical-align: middle;
               }
               header .page-tabs #menuOpen {
                    display:block;
                    padding: 1em 0;
               }
               header .page-tabs #menuOpen:after {
                    content: "Menu";
                    margin-left: 10px;
               }
               header .page-tabs ul {
                    list-style-type: none;
                    padding: 0;
               }
               header .page-tabs li {
                    padding: 1em 0;
                    display: block;
               }
               header .page-tabs a, header .page-tabs li, header .page-tabs button {
                    color: #EEE;
               }
               .app-button {
                    padding: 1em;
                    border: 0;
                    display: block;
                    background: transparent;
                    text-align:left;
               }
               @media (min-width: 768px) {
                    header .page-tabs {
                         width: 25% !important;
                    }
               }
               @media (max-width: 240px) {
                    header {
                         font-size: 0.5em;
                         overflow-y: hidden;
                         width:500%;
                    }
               }
          </style>
          <div class="container-fluid app-navbar">
               <div class="col-md-12">
                    <button id="menuOpen" class="app-button"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                    <span class='app-title'><?php echo TI_USU_ADMIN_TITLE ?></span>
               </div>
          </div>
          </div>
          <?php
              //  $u = new \App\Common\User($_SESSION['username']);
          ?>
          <div class="page-tabs">
               <ul>
                    <li><a href="<?php echo site_url("admin/site/index") ?>"><span class="glyphicon glyphicon-home"></span><span style="margin-left: 1em;">Home</span></a></li>
                    <li><a href="<?php echo site_url("admin/posts/index") ?>"><span class="glyphicon glyphicon-th-list"></span><span style="margin-left: 1em;">Posts</span></a></li>
                    <?php //if($u->getRoleNumber() == 1) { ?>
                    <li><a href=""><span class="glyphicon glyphicon-bookmark"></span><span style="margin-left: 1em;">Pages</span></a></li>
                    <?php //} ?>
                    <li><a href=""><span class="glyphicon glyphicon-calendar"></span><span style="margin-left: 1em;">Events</span></a></li>
                    <li><a href=""><span class="glyphicon glyphicon-folder-close"></span><span style="margin-left: 1em;">Category</span></a></li>
                    <li><a href=""><span class="glyphicon glyphicon-comment"></span><span style="margin-left: 1em;">Comments</span></a></li>
                    <li><a href=""><span class="glyphicon glyphicon-camera"></span><span style="margin-left: 1em;">Media</span></a></li>
                    <?php //if($u->getRoleNumber() == 1) { ?>
                    <li><a href=""><span class="glyphicon glyphicon-user"></span><span style="margin-left: 1em;">Users</span></a></li>
                    <?php //} ?>
                    <li><a href="<?php echo site_url("web/login/signout") ?>"><span class="glyphicon glyphicon-log-out"></span><span style="margin-left: 1em;">Log Out</span></a></li>
               </ul>
          </div>
     </header>
     <div class="content">
          <?php if(isset($content)) echo $content ?>
     </div>
     <footer>
          <div> &copy; <?php echo date('Y') ?> <a href="http://allgreenproject.me/" data-toggle="tooltip" title="Samuel Ezzay Tarigan" data-placement="top">e</a>-<a href="#" data-toggle="tooltip" title="Wendy Winata" data-placement="top">W</a><a href="#" data-toggle="tooltip" title="Alex Wijaya" data-placement="top">A</a><a href="http://mattw.in/" data-toggle="tooltip" title="Ruswan Effendi" data-placement="top">R</a>. All rights reserved. </div>
     </footer>
</body>
</html>
