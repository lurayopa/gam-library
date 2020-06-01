<?php

error_reporting(0);
session_start();
include("controllers/Login.php");
include("controllers/DataBase.php");
$route="";
$class="";
if(validateLogin())
{
  $route="home.php";
  $class = "skin-blue fixed sidebar-mini";
}
else
{
  $route="login.php";
  $class="hold-transition login-page";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>GAM</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
  
  <!-- Carga de Scripts-->
    <?php
    include("./config/general/headerScripts.php");
    ?>
  <!-- Carga de Scripts-->
</head>
<body class="<?=$class?>">
	<div id="content">
  <?php
    include("pages/".$route)
   ?>
	</div>
   <?php
    include("./config/general/footerScripts.php")
   ?>
</body>
</html>
