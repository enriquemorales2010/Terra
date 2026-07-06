<?php  

include_once("modulos/maquetado.php");
include_once("modulos/scripts_js.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Terra Constructura - Error de Ingreso</title>
	<?php echo head(); ?>
	<style type="text/css">
	 body{
	 	background-color: #2c3e50;
	 }
	</style>
</head>
<body>
	<?php echo insertarScripts(); ?>
	<script type="text/javascript">
swal({   
			title: "Error!",   
			text: "Debe iniciar sesión para ingresar al sistema.",   
			type: "error",   
			showCancelButton: false,   
			confirmButtonColor: "#3498db",   
			confirmButtonText: "Iniciar Sesión",     
			closeOnConfirm: false,   
			closeOnCancel: false }, 
			function(isConfirm){   
				if (isConfirm) {     
					window.location = "login.php"  
				} else {} 
			});
	</script>
</body>
</html>