<?php  

include_once("modulos/maquetado.php");

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Terra Constructora-Login</title>
  <?php echo head(); ?>
</head>
      <body class="hold-transition login-page">
        <div class="login-box">
          <div class="login-logo">
            <img src="dist/img/logo_terra_cuadrado.jpg" style="width: 50%; border-radius: 10px;">
          </div><!-- /.login-logo -->
          <div class="login-box-body" style=" border-radius: 10px;">
            <p class="login-box-msg">Inicia sesión en el sistema para la gestión</p>
            <form action="modulos/logIN.php" method="post">
              <div class="form-group has-feedback">
                <input type="email" name="usuario" class="form-control" placeholder="Correo Electrónico" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" name="pass" class="form-control" placeholder="Contraseña"  pattern=".{6,}" title="Mínimo 6 caracteres" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <button type="submit" class="btn btn-lg bg-red btn-block btn-flat">Entrar</button>
                </div><!-- /.col -->
              </div>
            </form>
            </br>
            <!--<a href="#">Olvide Mi Contraseña</a><br>
            <a href="register.html" class="text-center">Registrate Aqui</a>-->

          </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="plugins/iCheck/icheck.min.js"></script>
        <script>
        $(function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
          });
        });
        </script>
      </body>
      </html>