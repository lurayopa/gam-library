<?php
if(isset($_POST["txtUser"]))
{
    $user = $_POST["txtUser"];
    $pass = $_POST["txtPassword"];
    if(login($user,$pass)){
      header("location:index.php");
    }
    else
    {
      $messageError=true;
    }
}

?>

<div class="login-box">
  <div class="login-logo">
   <img src="img/emp/logoGamRojo.png" width="90%" height="180px">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingrese sus datos de inicio</p>

    <form name="forma" id="forma" method="post" action="">
      <?php
      if($messageError)
      {
      ?>
        <div id="divError" class="alert alert-danger">Usuario o contrase&ntilde;a incorrecta</div>
      <?php
      }
      ?>
      
      <div class="form-group has-feedback">
        <input name="txtUser" type="text" autofocus class="form-control" placeholder="Usuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="txtPassword" type="password" value="" class="form-control" placeholder="Contrase&ntilde;a" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="col-6 position-center">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
      </div>
    </form>
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-box-body -->
</div>