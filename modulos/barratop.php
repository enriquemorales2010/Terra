<?php 

echo "<!-- Sidebar toggle button-->";
echo "        <a href='#' class='sidebar-toggle' data-toggle='offcanvas' role='button'>";
echo "          <span class='sr-only'>Toggle navigation</span>";
echo "        </a>";
echo "        <!-- Navbar Right Menu -->";
echo "        <div class='navbar-custom-menu'>";
echo "          <ul class='nav navbar-nav'>";
echo "            <!-- User Account Menu -->";
echo "            <li class='dropdown user user-menu'>";
echo "              <!-- Menu Toggle Button -->";
echo "              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>";
echo "                <!-- The user image in the navbar-->";

echo "                <!-- hidden-xs hides the username on small devices so only the image appears. -->";
echo "                <span class='hidden-xs'>".$_SESSION['nombre_usuario']." ".$_SESSION['apellido_usuario']."</span>";
echo "              </a>";
echo "              <ul class='dropdown-menu'>";
echo "                <!-- The user image in the menu -->";
echo "                <li class='user-header'>";
echo "                  <img src='dist/img/logo_terra_cuadrado.jpg' class='img-circle' alt='User Image'>";
echo "                  <p>";
echo "                    ".$_SESSION['nombre_usuario']." ".$_SESSION['apellido_usuario']."";
echo "                    <small>".$_SESSION['perfil']."</small>";
echo "                  </p>";
echo "                </li>";
echo "                <!-- Menu Footer-->";
echo "                <li class='user-footer'>";
echo "                  <div class='pull-left'>";
echo "                    <a href='perfil_usuario.php' class='btn btn-default btn-flat'>Perfil Usuario</a>";
echo "                  </div>";
echo "                  <div class='pull-right'>";
echo "                    <a href='modulos/logOUT.php' class='btn btn-default btn-flat'>Salir del Sistema</a>";
echo "                  </div>";
echo "                </li>";
echo "              </ul>";
echo "            </li>";
echo "          </ul>";
echo "        </div>";

 ?>