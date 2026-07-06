<?php 


function menuSuperAdministrador() {

  $arrayNombre = explode(' ', $_SESSION['nombre_usuario'], 2);
  $arrayApellido = explode(' ',$_SESSION['apellido_usuario'], 2);

  return "<section class='sidebar'>
        <!-- Sidebar user panel (optional) -->
        <div class='user-panel'>
          <img src='dist/img/logo_terra_cuadrado.jpg' style='max-width:100%' >       
        </div>
        <!-- Sidebar Menu -->
        <ul class='sidebar-menu'>
          <li class='header' style='text-align: center'>MENU PRINCIPAL</li>
          <!-- Optionally, you can add icons to the links -->
          <li><a href='index.php'><i class='fa fa-home'></i> <span>Inicio</span></a></li>
          <li class='treeview'>
            <a href=''><i class='fa fa-table'></i> <span>Tablas Maestras</span> <i class='fa fa-chevron-down pull-right'></i></a>
            <ul class='treeview-menu'>
              <li><a href='lista_usuarios.php'><i class='fa fa-cog'></i> Gestión de Usuarios</a></li>
              <li><a href='lista_edificios.php'><i class='fa fa-cog'></i> Gestión de Edificio</a></li>
              <li><a href='lista_prov.php'><i class='fa fa-cog'></i> Gestión de Proveedores</a></li>
              <li><a href='lista_falla.php'><i class='fa fa-cog'></i> Gestión de Fallas</a></li>
              
              
            </ul>
          </li>
          
             
              

               
            </ul>
          </li>

        
          

        </ul><!-- /.sidebar-menu -->
      </section>";
}

function menuEncargado() {
  $arrayNombre = explode(' ', $_SESSION['nombre_usuario'], 2);
  $arrayApellido = explode(' ',$_SESSION['apellido_usuario'], 2);

  return "<section class='sidebar'>
        <!-- Sidebar user panel (optional) -->
        <div class='user-panel'>
          <div class='user-panel'>
          
            <img src='dist/img/logo_terra_cuadrado.jpg' style='max-width:100%' >
          
          
        </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class='sidebar-menu'>
              <li class='header' style='text-align: center'>MENU PRINCIPAL</li>
              <!-- Optionally, you can add icons to the links -->
              <li><a href='index.php'><i class='fa fa-home'></i> <span>Inicio</span></a></li>
              <li class='treeview'>
              <a href='#'><i class='fa fa-group'></i> <span>Transportistas</span> <i class='fa fa-angle-left pull-right'></i></a>
              <ul class='treeview-menu'>
              <li><a href='lista_transportistas.php'><i class='fa fa-cog'></i> Gestión de Transportistas</a></li>
              </ul>
              </li>


              <li class='treeview'>
              <a href='#'><i class='fa fa-truck'></i> <span>Vehículos</span> <i class='fa fa-angle-left pull-right'></i></a>
              <ul class='treeview-menu'>
              <li><a href='lista_vehiculos.php'><i class='fa fa-cog'></i> Gestión de Vehículos</a></li>
              </ul>
              </li>

              <li class='treeview'>
              <a href='#'><i class='fa fa-exclamation-circle'></i> <span>Incidencias</span> <i class='fa fa-angle-left pull-right'></i></a>
              <ul class='treeview-menu'>
              <li><a href='lista_incidencias.php'><i class='fa fa-cog'></i> Gestión de Incidencias</a></li>
              <li><a href='lista_solicitudes_b.php'><i class='fa fa-flag'></i> Solicitudes</a></li>
              <li><a href='lista_empleado.php'><i class='fa fa-cog'></i> Gestión de Empleados</a></li>
              </ul>
              </li>

              <li class='treeview'>
              <a href='#'><i class='fa fa-building-o'></i> <span>Proveedores de Servicios</span> <i class='fa fa-angle-left pull-right'></i></a>
              <ul class='treeview-menu'>
              <li><a href='lista_prov.php'><i class='fa fa-cog'></i> Gestión de Proveedores de<br> Servicios</a></li>
              </ul>
              </li>

              <li class='treeview'>
              <a href='#'><i class='fa fa-file-text'></i> <span>Reportes</span> <i class='fa fa-angle-left pull-right'></i></a>
              <ul class='treeview-menu'>
              <li><a href='lista_reportes.php'><i class='fa fa-plus'></i> Gestión de Reportes</a></li>
              </ul>
              </li>
              
              <li class='treeview'>
              <a href='#'><i class='fa fa-file-text'></i> <span> Control de Salida <br> No Conforme</span> <i class='fa fa-angle-left pull-right'></i></a>
              <ul class='treeview-menu'>
              <li><a href='salida_noc.php'><i class='fa fa-plus'></i> Registro de Salida <br> No Conforme.</a></li>
              </ul>
              </li>
              

              <li class='treeview'>
              <a href='#'><i class='fa fa-file-text'></i> <span> Control de Salida <br> No Conforme</span><i class='fa fa-chevron-down pull-right'></i></a>
              <ul class='treeview-menu'>
              <li><a href='lista_salidanc.php'><i class='fa fa-plus'></i> Lista de Control de <br> Salida No Conforme.</a></li>
              </ul>
              </li>
              
              <li class='treeview'>
          <a href='#'><i class='fa fa-exclamation-triangle'></i> <span>Post-Ventas</span><i class='fa fa-chevron-down pull-right'></i></a>
          <ul class='treeview-menu'>
              <li><a href='lista_postv.php'><i class='fa fa-cog'></i> Gestión de Post-Ventas</a></li>
              <li><a href='grafico_post.php'><i class='fa fa-area-chart'></i>Dashboard Post-Ventas</a></li>
               <li><a href='grafico_costo.php'><i class='fa fa-area-chart'></i>Dashboard Costos</a></li>
            </ul>
          </li>



              </ul><!-- /.sidebar-menu -->
              </section>";
}

function menuAdministrador() {
  $arrayNombre = explode(' ', $_SESSION['nombre_usuario'], 2);
  $arrayApellido = explode(' ',$_SESSION['apellido_usuario'], 2);

  return "<section class='sidebar'>
        <!-- Sidebar user panel (optional) -->
       <div class='user-panel'>
          
            <img src='dist/img/logo_terra_cuadrado.jpg' style='max-width:100%' >
          
          
        </div>
        <!-- Sidebar Menu -->
        <ul class='sidebar-menu'>
          <li class='header' style='text-align: center'>MENU PRINCIPAL</li>
          <!-- Optionally, you can add icons to the links -->
          <li><a href='index.php'><i class='fa fa-home'></i> <span>Inicio</span></a></li>

      </section>";
}

function menuEjecutivo() {
  $arrayNombre = explode(' ', $_SESSION['nombre_usuario'], 2);
  $arrayApellido = explode(' ',$_SESSION['apellido_usuario'], 2);

  return "<section class='sidebar'>
        <!-- Sidebar user panel (optional) -->
        <div class='user-panel'>
          <img src='dist/img/logo_terra_cuadrado.jpg' style='max-width:100%' >       
        </div>
        <!-- Sidebar Menu -->
        <ul class='sidebar-menu'>
          <li class='header' style='text-align: center'>MENU PRINCIPAL</li>
          <!-- Optionally, you can add icons to the links -->
          <li><a href='index.php'><i class='fa fa-home'></i> <span>Inicio</span></a></li>
          <li class='treeview'>
          <a href='lista_postv.php'><i class='fa fa-exclamation-triangle'></i> <span>Post-Ventas</span></i></a>
          </li>

          <li class='treeview'>
              <a href='#'><i class='fa fa-file-text'></i> <span> Control de Salida <br> No Conforme</span><i class='fa fa-chevron-down pull-right'></i></a>
              <ul class='treeview-menu'>
              <li><a href='lista_salidanc.php'><i class='fa fa-plus'></i> Lista de Control de <br> Salida No Conforme.</a></li>
              </ul>
              </li>
              
               
            </ul>
          </li>
          

        </ul><!-- /.sidebar-menu -->
      </section>";
}


function menuCoorCalid() {
  $arrayNombre = explode(' ', $_SESSION['nombre_usuario'], 2);
  $arrayApellido = explode(' ',$_SESSION['apellido_usuario'], 2);

  return "<section class='sidebar'>
        <!-- Sidebar user panel (optional) -->
       <div class='user-panel'>
          
            <img src='dist/img/logo_terra_cuadrado.jpg' style='max-width:100%' >
          
          
        </div>
        <!-- Sidebar Menu -->
        <ul class='sidebar-menu'>
          <li class='header' style='text-align: center'>MENU PRINCIPAL</li>
          <!-- Optionally, you can add icons to the links -->
          <li><a href='index.php'><i class='fa fa-home'></i> <span>Inicio</span></a></li>

        </ul>
          

      </section>";
}

function menuencCalid() {
  $arrayNombre = explode(' ', $_SESSION['nombre_usuario'], 2);
  $arrayApellido = explode(' ',$_SESSION['apellido_usuario'], 2);

  return "<section class='sidebar'>
        <!-- Sidebar user panel (optional) -->
       <div class='user-panel'>
          
            <img src='dist/img/logo_terra_cuadrado.jpg' style='max-width:100%' >
          
          
        </div>
        <!-- Sidebar Menu -->
        <ul class='sidebar-menu'>
          <li class='header' style='text-align: center'>MENU PRINCIPAL</li>
          <!-- Optionally, you can add icons to the links -->
          <li><a href='index.php'><i class='fa fa-home'></i> <span>Inicio</span></a></li>

      </section>";
}

function menuLlamarEncargado() {
  $arrayNombre = explode(' ', $_SESSION['nombre_usuario'], 2);
  $arrayApellido = explode(' ',$_SESSION['apellido_usuario'], 2);

  return "<section class='sidebar'>
        <!-- Sidebar user panel (optional) -->
       <div class='user-panel'>
          
            <img src='dist/img/logo_terra_cuadrado.jpg' style='max-width:100%' >
          
          
        </div>
        <!-- Sidebar Menu -->
        <ul class='sidebar-menu'>
          <li class='header' style='text-align: center'>MENU PRINCIPAL</li>
          <!-- Optionally, you can add icons to the links -->
          <li><a href='index.php'><i class='fa fa-home'></i> <span>Llamar A Encargado PivotData</span></a></li>
          

      </section>";
}


function menuUsuarioB() {
  $arrayNombre = explode(' ', $_SESSION['nombre_usuario'], 2);
  $arrayApellido = explode(' ',$_SESSION['apellido_usuario'], 2);

  return "<section class='sidebar'>
        <!-- Sidebar user panel (optional) -->
        <div class='user-panel'>
          <img src='dist/img/logo_terra_cuadrado.jpg' style='max-width:100%' >       
        </div>
        <!-- Sidebar Menu -->
        <ul class='sidebar-menu'>
          <li class='header' style='text-align: center'>MENU PRINCIPAL</li>
          <!-- Optionally, you can add icons to the links -->
          <li><a href='index.php'><i class='fa fa-home'></i> <span>Inicio</span></a></li>
                        
               
            </ul>
          </li>
          

        </ul><!-- /.sidebar-menu -->
      </section>";
}

function menuPrevRies() {
  $arrayNombre = explode(' ', $_SESSION['nombre_usuario'], 2);
  $arrayApellido = explode(' ',$_SESSION['apellido_usuario'], 2);

  return "<section class='sidebar'>
        <!-- Sidebar user panel (optional) -->
        <div class='user-panel'>
          <img src='dist/img/logo_terra_cuadrado.jpg' style='max-width:100%' >       
        </div>
        <!-- Sidebar Menu -->
        <ul class='sidebar-menu'>
          <li class='header' style='text-align: center'>MENU PRINCIPAL</li>
          <!-- Optionally, you can add icons to the links -->
          <li><a href='index.php'><i class='fa fa-home'></i> <span>Inicio</span></a></li>
                        
               
            </ul>
          </li>
          

        </ul><!-- /.sidebar-menu -->
      </section>";
}




?>