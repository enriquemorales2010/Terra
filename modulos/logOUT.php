<?php 
	

//Iniciar la sesión
session_start();

//Vaciar las varibles
session_unset();

//cerrar la sesión
session_destroy();
header("Location: ../login.php");
 

 ?>